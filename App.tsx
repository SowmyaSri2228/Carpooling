import React, { useState, useCallback } from 'react';
import { GoogleMap, LoadScript, DirectionsService, DirectionsRenderer } from '@react-google-maps/api';
import { MapPin, Navigation, AlertCircle, Car, Bike, Train, Scaling as Walking, Info } from 'lucide-react';

const GOOGLE_MAPS_API_KEY = import.meta.env.VITE_GOOGLE_MAPS_API_KEY;

const mapContainerStyle = {
  width: '100%',
  height: '400px'
};

const center = {
  lat: 40.7128,
  lng: -74.0060
};

type TransportMode = google.maps.TravelMode;
type RouteInfo = {
  mode: TransportMode;
  result: google.maps.DirectionsResult;
};

const transportModes: { mode: TransportMode; label: string; icon: React.ReactNode }[] = [
  { mode: 'DRIVING', label: 'Car', icon: <Car className="w-5 h-5" /> },
  { mode: 'BICYCLING', label: 'Bike', icon: <Bike className="w-5 h-5" /> },
  { mode: 'TRANSIT', label: 'Transit', icon: <Train className="w-5 h-5" /> },
  { mode: 'WALKING', label: 'Walking', icon: <Walking className="w-5 h-5" /> },
];

function App() {
  const [origin, setOrigin] = useState('');
  const [destination, setDestination] = useState('');
  const [routes, setRoutes] = useState<RouteInfo[]>([]);
  const [selectedRoute, setSelectedRoute] = useState<RouteInfo | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [isLoading, setIsLoading] = useState(false);
  const [loadingModes, setLoadingModes] = useState<Set<TransportMode>>(new Set());
  const [modeErrors, setModeErrors] = useState<Map<TransportMode, string>>(new Map());

  const directionsCallback = useCallback((
    mode: TransportMode,
    result: google.maps.DirectionsResult | null,
    status: google.maps.DirectionsStatus
  ) => {
    setLoadingModes(prev => {
      const next = new Set(prev);
      next.delete(mode);
      return next;
    });

    if (result !== null && status === 'OK') {
      setRoutes(prev => {
        const filtered = prev.filter(r => r.mode !== mode);
        return [...filtered, { mode, result }];
      });
      setModeErrors(prev => {
        const next = new Map(prev);
        next.delete(mode);
        return next;
      });
      if (!selectedRoute) {
        setSelectedRoute({ mode, result });
      }
    } else {
      let errorMessage = '';
      switch (status) {
        case 'NOT_FOUND':
          errorMessage = 'Location not found. Please provide more specific addresses.';
          break;
        case 'ZERO_RESULTS':
          errorMessage = `No ${mode.toLowerCase()} route available between these locations.`;
          break;
        case 'MAX_ROUTE_LENGTH_EXCEEDED':
          errorMessage = 'Distance too far for this transport mode.';
          break;
        default:
          errorMessage = 'Could not find route.';
      }
      setModeErrors(prev => new Map(prev).set(mode, errorMessage));
      console.log(`Route not found for mode: ${mode} - ${status}`);
    }

    if (loadingModes.size === 1 && routes.length === 0) {
      setError('No routes found. Please check the addresses and try again.');
    }
  }, [loadingModes, selectedRoute, routes.length]);

  const handleSearch = useCallback(() => {
    if (!origin.trim() || !destination.trim()) {
      setError('Please enter both origin and destination');
      return;
    }

    // Validate addresses have enough detail
    if (origin.length < 5 || destination.length < 5) {
      setError('Please provide more specific addresses (street, city, etc.)');
      return;
    }

    setIsLoading(true);
    setError(null);
    setRoutes([]);
    setSelectedRoute(null);
    setModeErrors(new Map());
    setLoadingModes(new Set(transportModes.map(t => t.mode)));
  }, [origin, destination]);

  const getTransitDetails = (leg: google.maps.DirectionsLeg) => {
    if (!leg.steps) return null;
    
    const transitSteps = leg.steps.filter(step => step.travel_mode === 'TRANSIT');
    if (transitSteps.length === 0) return null;

    return (
      <div className="mt-2 text-sm text-gray-600">
        {transitSteps.map((step, idx) => (
          <div key={idx} className="flex items-center space-x-1">
            <Train className="w-4 h-4" />
            <span>{step.transit?.line?.vehicle?.name || 'Transit'}: {step.transit?.line?.short_name || step.transit?.line?.name}</span>
          </div>
        ))}
      </div>
    );
  };

  if (!GOOGLE_MAPS_API_KEY) {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center">
        <div className="bg-white rounded-lg shadow-lg p-6 max-w-md">
          <h1 className="text-2xl font-bold text-red-600 mb-4">Configuration Error</h1>
          <p className="text-gray-700">
            Please set up your Google Maps API key in the .env file:
          </p>
          <ol className="list-decimal ml-6 mt-4 space-y-2 text-gray-600">
            <li>Create a .env file in the project root</li>
            <li>Add your API key: VITE_GOOGLE_MAPS_API_KEY=your_api_key_here</li>
            <li>Restart the development server</li>
          </ol>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="max-w-6xl mx-auto px-4 py-8">
        <div className="bg-white rounded-lg shadow-lg p-6 mb-8">
          <h1 className="text-3xl font-bold text-gray-800 mb-6 flex items-center">
            <Navigation className="mr-2 text-blue-600" />
            Multi-Mode Route Finder
          </h1>
          
          <div className="mb-4 p-4 bg-blue-50 rounded-lg flex items-start space-x-2">
            <Info className="text-blue-600 flex-shrink-0 mt-0.5" />
            <p className="text-blue-700 text-sm">
              For best results, please provide specific addresses including street names, city, and state/country.
              Example: "350 5th Ave, New York, NY, USA"
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div className="flex items-center space-x-2">
              <MapPin className="text-green-600 flex-shrink-0" />
              <input
                type="text"
                placeholder="Enter specific origin address (e.g., 350 5th Ave, New York, NY)"
                value={origin}
                onChange={(e) => setOrigin(e.target.value)}
                className="flex-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
            </div>
            
            <div className="flex items-center space-x-2">
              <MapPin className="text-red-600 flex-shrink-0" />
              <input
                type="text"
                placeholder="Enter specific destination address (e.g., 20 W 34th St, New York, NY)"
                value={destination}
                onChange={(e) => setDestination(e.target.value)}
                className="flex-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
            </div>
          </div>

          <button
            onClick={handleSearch}
            disabled={!origin.trim() || !destination.trim() || loadingModes.size > 0}
            className="w-full mb-6 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 disabled:bg-blue-300 disabled:cursor-not-allowed transition-colors"
          >
            {loadingModes.size > 0 ? 'Finding Routes...' : 'Find Routes'}
          </button>

          {error && (
            <div className="mb-6 p-4 bg-red-50 border border-red-200 rounded-md flex items-start space-x-2">
              <AlertCircle className="text-red-600 flex-shrink-0 mt-0.5" />
              <p className="text-red-700">{error}</p>
            </div>
          )}

          <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div className="rounded-lg overflow-hidden">
              <LoadScript googleMapsApiKey={GOOGLE_MAPS_API_KEY}>
                <GoogleMap
                  mapContainerStyle={mapContainerStyle}
                  zoom={12}
                  center={center}
                >
                  {origin && destination && !error && transportModes.map(({ mode }) => (
                    <DirectionsService
                      key={mode}
                      options={{
                        destination,
                        origin,
                        travelMode: mode,
                        provideRouteAlternatives: true,
                      }}
                      callback={(result, status) => directionsCallback(mode, result, status)}
                    />
                  ))}
                  {selectedRoute && (
                    <DirectionsRenderer
                      options={{
                        directions: selectedRoute.result,
                        routeIndex: 0,
                      }}
                    />
                  )}
                </GoogleMap>
              </LoadScript>
            </div>

            <div className="space-y-4">
              {routes.map(({ mode, result }) => (
                <div
                  key={mode}
                  onClick={() => setSelectedRoute({ mode, result })}
                  className={`p-4 rounded-lg border-2 cursor-pointer transition-colors ${
                    selectedRoute?.mode === mode
                      ? 'border-blue-500 bg-blue-50'
                      : 'border-gray-200 hover:border-blue-300'
                  }`}
                >
                  <div className="flex items-center justify-between mb-2">
                    <div className="flex items-center space-x-2">
                      {transportModes.find(t => t.mode === mode)?.icon}
                      <span className="font-semibold">{mode.charAt(0) + mode.slice(1).toLowerCase()}</span>
                    </div>
                    <div className="text-right">
                      <div className="font-medium">{result.routes[0].legs[0].duration?.text}</div>
                      <div className="text-sm text-gray-600">{result.routes[0].legs[0].distance?.text}</div>
                    </div>
                  </div>
                  {mode === 'TRANSIT' && getTransitDetails(result.routes[0].legs[0])}
                </div>
              ))}
              {Array.from(modeErrors.entries()).map(([mode, error]) => (
                <div key={mode} className="p-4 rounded-lg border-2 border-gray-200 bg-gray-50">
                  <div className="flex items-center justify-between">
                    <div className="flex items-center space-x-2">
                      {transportModes.find(t => t.mode === mode)?.icon}
                      <span className="font-semibold">{mode.charAt(0) + mode.slice(1).toLowerCase()}</span>
                    </div>
                    <div className="text-sm text-red-600">{error}</div>
                  </div>
                </div>
              ))}
            </div>
          </div>

          {selectedRoute && selectedRoute.result.routes.length > 1 && (
            <div className="mt-4">
              <h3 className="text-lg font-semibold mb-2">Alternative Routes</h3>
              <div className="space-y-2">
                {selectedRoute.result.routes.slice(1).map((route, idx) => (
                  <div key={idx} className="p-3 bg-gray-50 rounded-lg">
                    <div className="flex justify-between items-center">
                      <span className="font-medium">Alternative {idx + 1}</span>
                      <div className="text-right">
                        <div>{route.legs[0].duration?.text}</div>
                        <div className="text-sm text-gray-600">{route.legs[0].distance?.text}</div>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

export default App;