let map;
let directionsService;
let directionsRenderer;

// Add loading state
let isLoading = false;

// Initialize Google Maps
function initMap() {
    try {
        // Initialize the map first
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: { lat: 20.5937, lng: 78.9629 }, // Center of India
            mapTypeControl: true,
            streetViewControl: true
        });

        // Initialize directions service and renderer
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
            panel: document.getElementById('map')
        });

        // Initialize autocomplete with India bounds
        const defaultBounds = {
            north: 35.513327,
            south: 6.4626999,
            east: 97.395561,
            west: 68.7917517,
        };

        const options = {
            bounds: defaultBounds,
            componentRestrictions: { country: 'in' },
            fields: ['address_components', 'geometry', 'name'],
            strictBounds: false
        };

        const pickupInput = document.getElementById('pickup');
        const destinationInput = document.getElementById('destination');
        
        new google.maps.places.Autocomplete(pickupInput, options);
        new google.maps.places.Autocomplete(destinationInput, options);

    } catch (error) {
        console.error('Map initialization failed:', error);
        alert('Failed to initialize map. Please check your internet connection and reload the page.');
    }
}

// Update form submission
document.getElementById('rideForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    if (isLoading) return;
    
    try {
        isLoading = true;
        const submitButton = document.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.textContent = 'Calculating...';
        
        // Get form values
        const pickup = document.getElementById('pickup')?.value;
        const destination = document.getElementById('destination')?.value;
        const date = document.getElementById('date')?.value;
        const time = document.getElementById('time')?.value;
        const passengersSelect = document.getElementById('passengers');
        const passengers = parseInt(passengersSelect?.value);
        const vehicleType = document.querySelector('input[name="vehicleType"]:checked')?.value;

        // Validate all required fields
        if (!pickup || !destination || !date || !time || !passengers || !vehicleType) {
            throw new Error('Please fill in all required fields');
        }

        // Show results section
        document.querySelector('.results-section').style.display = 'block';

        if (validateInputs(pickup, destination, date, time, passengers)) {
            const route = await calculateRoute(pickup, destination);
            if (route) {
                // Show booking details
                displayBookingDetails({
                    pickup,
                    destination,
                    date,
                    time,
                    passengers,
                    vehicleType,
                    distance: route.distance.text,
                    duration: route.duration.text
                });
                
                // Display transport options filtered by vehicle type
                displayTransportOptions(route, passengers, vehicleType);
                
                // Scroll to results
                document.querySelector('.results-section').scrollIntoView({ 
                    behavior: 'smooth' 
                });
            }
        }
    } catch (error) {
        console.error('Route calculation error:', error);
        alert('Error: ' + error.message);
    } finally {
        isLoading = false;
        const submitButton = document.querySelector('button[type="submit"]');
        submitButton.disabled = false;
        submitButton.textContent = 'Search';
    }
});

// Update validation function
function validateInputs(pickup, destination, date, time, passengers) {
    const today = new Date();
    const selectedDate = new Date(date + 'T' + time);
    
    // Reset hours for today's date for proper comparison
    today.setSeconds(0);
    today.setMilliseconds(0);
    
    if (selectedDate < today) {
        throw new Error('Cannot select past date and time');
    }
    
    if (!passengers || isNaN(passengers)) {
        throw new Error('Please select number of passengers');
    }
    
    if (passengers < 1) {
        throw new Error('Number of passengers must be at least 1');
    }
    
    if (passengers > 4) {
        throw new Error('Maximum 4 passengers allowed');
    }
    
    return true;
}

// Add this to set minimum date to today
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');
    const today = new Date().toISOString().split('T')[0];
    dateInput.min = today;
    dateInput.value = today;

    const timeInput = document.getElementById('time');
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    timeInput.value = `${hours}:${minutes}`;

    // Check if user is logged in
    const user = JSON.parse(localStorage.getItem('currentUser'));
    if (!user) {
        // If no user is logged in, update the profile button to show "Login"
        document.getElementById('profileTitle').textContent = 'Login';
    }

    // Update profile icon if user is logged in
    if (user) {
        const userProfile = document.querySelector('.user-profile');
        userProfile.innerHTML = `
            ${user.firstName.charAt(0)}${user.lastName.charAt(0)}
            <div class="profile-dropdown" id="profileDropdown">
                <div class="profile-header">
                    <h3>Profile Details</h3>
                </div>
                <div class="profile-info">
                    <div id="userDetails">
                        <div class="profile-field">
                            <label>Username</label>
                            <p class="user-info" id="viewUsername"></p>
                        </div>
                        <div class="profile-field">
                            <label>Name</label>
                            <p class="user-info" id="viewFullName"></p>
                        </div>
                        <div class="profile-field">
                            <label>Mobile Number</label>
                            <p class="user-info" id="viewMobile"></p>
                        </div>
                        <button class="logout-btn" onclick="logout()">Logout</button>
                    </div>
                </div>
            </div>
        `;
    }
});

// Calculate route using Google Maps Directions API
function calculateRoute(origin, destination) {
    return new Promise((resolve, reject) => {
        if (!directionsService || !directionsRenderer) {
            reject('Maps not initialized properly');
            return;
        }

        const request = {
            origin: origin,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING,
            provideRouteAlternatives: true
        };

        directionsService.route(request, (result, status) => {
            if (status === 'OK') {
                directionsRenderer.setDirections(result);
                
                // Get the primary route
                const route = result.routes[0].legs[0];
                const routeInfo = {
                    distance: route.distance,
                    duration: route.duration,
                    start_address: route.start_address,
                    end_address: route.end_address
                };
                
                resolve(routeInfo);
            } else {
                console.error('Directions request failed due to ' + status);
                reject('Could not calculate route. Please check your locations and try again.');
            }
        });
    });
}

// Display transport options and prices
function displayTransportOptions(routeInfo, passengers, vehicleType) {
    const distanceInKm = routeInfo.distance.value / 1000;
    const duration = routeInfo.duration.text;
    const transportOptions = document.querySelector('.transport-options');
    
    // Clear previous results
    transportOptions.innerHTML = '';

    // Add route summary
    const summary = document.createElement('div');
    summary.className = 'route-summary';
    summary.innerHTML = `
        <h3>Route Information</h3>
        <p>Distance: ${routeInfo.distance.text}</p>
        <p>Estimated Duration: ${duration}</p>
    `;
    transportOptions.appendChild(summary);

    // Calculate prices with surge pricing during peak hours
    const isPeakHour = checkPeakHour();
    const surgeFactor = isPeakHour ? 1.2 : 1;

    // Define vehicle options with their specific calculations
    const options = [
        {
            type: 'Bike',
            price: calculateBikePrice(distanceInKm, surgeFactor),
            capacity: 1,
            icon: '🏍️',
            speed: 'Fastest',
            trafficImpact: 'Low',
            baseRate: '₹7/km + ₹20 base fare'
        },
        {
            type: 'Car',
            price: calculateCarPrice(distanceInKm, surgeFactor),
            capacity: 4,
            icon: '🚗',
            speed: 'Medium',
            trafficImpact: 'Medium',
            baseRate: '₹10/km + ₹50 base fare'
        }
    ];

    // Filter options based on vehicle type and passenger count
    let filteredOptions = options;
    if (vehicleType !== 'any') {
        filteredOptions = options.filter(option => 
            option.type.toLowerCase() === vehicleType.toLowerCase()
        );
    }

    // Filter by passenger capacity
    filteredOptions = filteredOptions.filter(option => passengers <= option.capacity);

    if (filteredOptions.length === 0) {
        transportOptions.innerHTML += `
            <div class="no-options">
                <p>No available vehicles for ${passengers} passengers with the selected vehicle type.</p>
                <p>Please try different options or reduce the number of passengers.</p>
            </div>
        `;
        return;
    }

    filteredOptions.forEach(option => {
        const card = document.createElement('div');
        card.className = 'transport-card';
        
        card.innerHTML = `
            <h3>${option.icon} ${option.type}</h3>
            <p>Distance: ${routeInfo.distance.text}</p>
            <p>Estimated Time: ${routeInfo.duration.text}</p>
            <p class="price">₹${option.price.toFixed(2)}</p>
            <p>Capacity: ${option.capacity} persons</p>
            <p>Traffic Impact: ${option.trafficImpact}</p>
            <p class="rate-info">Rate: ${option.baseRate}</p>
            ${isPeakHour ? '<p class="peak-hour">Peak Hour Surge Pricing Applied (20% extra)</p>' : ''}
            <button class="book-now-btn" onclick="bookRide('${option.type}', ${option.price})">Book Now</button>
        `;
        
        transportOptions.appendChild(card);
    });
}

// Updated price calculation functions with surge pricing
function calculateBikePrice(distance, surgeFactor = 1) {
    const baseRate = 7;
    const baseFare = 20;
    const price = (distance * baseRate + baseFare) * surgeFactor;
    return Math.round(price); // Round to nearest rupee
}

function calculateCarPrice(distance, surgeFactor = 1) {
    const baseRate = 10;
    const baseFare = 50;
    const price = (distance * baseRate + baseFare) * surgeFactor;
    return Math.round(price);
}

function calculateBusPrice(distance, surgeFactor = 1) {
    const baseRate = 8;
    const baseFare = 30;
    const price = (distance * baseRate + baseFare) * surgeFactor;
    return Math.round(price);
}

// Check for peak hours
function checkPeakHour() {
    const now = new Date();
    const hour = now.getHours();
    // Define peak hours (8-10 AM and 5-7 PM)
    return (hour >= 8 && hour <= 10) || (hour >= 17 && hour <= 19);
}

// Updated transport card creation
function createTransportCard(option, routeInfo) {
    const card = document.createElement('div');
    card.className = 'transport-card';
    
    const isPeakHour = checkPeakHour();
    
    card.innerHTML = `
        <h3>${option.icon} ${option.type}</h3>
        <p>Distance: ${routeInfo.distance.text}</p>
        <p>Estimated Time: ${routeInfo.duration.text}</p>
        <p class="price">₹${option.price.toFixed(2)}</p>
        <p>Capacity: ${option.capacity} persons</p>
        <p>Traffic Impact: ${option.trafficImpact}</p>
        ${isPeakHour ? '<p class="peak-hour">Peak Hour Surge Pricing Applied</p>' : ''}
    `;
    
    return card;
}

// Add function to display booking details
function displayBookingDetails(details) {
    const bookingDetails = document.getElementById('bookingDetails');
    const content = bookingDetails.querySelector('.details-content');
    
    // Format date and time
    const formattedDate = new Date(details.date + 'T' + details.time).toLocaleString('en-IN', {
        dateStyle: 'full',
        timeStyle: 'short'
    });

    content.innerHTML = `
        <div class="detail-item">
            <strong>From</strong>
            <span>${details.pickup}</span>
        </div>
        <div class="detail-item">
            <strong>To</strong>
            <span>${details.destination}</span>
        </div>
        <div class="detail-item">
            <strong>Date & Time</strong>
            <span>${formattedDate}</span>
        </div>
        <div class="detail-item">
            <strong>Passengers</strong>
            <span>${details.passengers} person(s)</span>
        </div>
        <div class="detail-item">
            <strong>Distance</strong>
            <span>${details.distance}</span>
        </div>
        <div class="detail-item">
            <strong>Estimated Duration</strong>
            <span>${details.duration}</span>
        </div>
        <div class="detail-item">
            <strong>Preferred Vehicle</strong>
            <span>${details.vehicleType.charAt(0).toUpperCase() + details.vehicleType.slice(1)}</span>
        </div>
    `;
    
    bookingDetails.style.display = 'block';
}

// Add booking functionality
function bookRide(vehicleType, price) {
    const confirmBook = confirm(`Confirm booking for ${vehicleType} at ₹${price.toFixed(2)}?`);
    if (confirmBook) {
        alert(`Booking confirmed for ${vehicleType}! A driver will be assigned shortly.`);
    }
}

// Initialize map when the page loads
window.initMap = initMap;

// Add error handling for map loading
window.gm_authFailure = function() {
    console.error('Google Maps failed to load');
    alert('Failed to load Google Maps. Please check your API key and try again.');
};

function toggleProfileDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    const user = JSON.parse(localStorage.getItem('currentUser'));
    
    if (!user) {
        alert('Please login first');
        return;
    }
    
    dropdown.classList.toggle('active');
    if (dropdown.classList.contains('active')) {
        showUserDetails(user);
    }
}

function showUserDetails(user) {
    document.getElementById('viewUsername').textContent = user.username;
    document.getElementById('viewFullName').textContent = `${user.firstName} ${user.lastName}`;
    document.getElementById('viewMobile').textContent = user.mobile;
}

function logout() {
    if (confirm('Are you sure you want to logout?')) {
        localStorage.removeItem('currentUser');
        window.location.reload(); // Refresh the page after logout
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('profileDropdown');
    const userProfile = document.querySelector('.user-profile');
    
    if (!userProfile.contains(event.target) && dropdown.classList.contains('active')) {
        dropdown.classList.remove('active');
    }
}); 