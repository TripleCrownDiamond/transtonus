<div class="p-4 lg:p-6 bg-gradient-to-r from-[#00A7E1] to-[#00A7E1] border-b border-gray-200 rounded-t-lg">
    <h1 class="text-xl font-bold text-white flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-5 h-5 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75z" />
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625z" />
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
        </svg>
        Statistiques
    </h1>
</div>

<div class="bg-gray-100 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 p-4">
    <!-- Carte : Pays le plus visité -->
    <div
        class="bg-gradient-to-br from-white to-blue-50 p-3 rounded-lg shadow-sm border border-blue-100 transform transition duration-200 hover:scale-105">
        <div class="flex items-center mb-2">
            <div class="bg-blue-100 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    class="w-4 h-4 stroke-blue-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 21a9 9 0 01-6.5-15.5A9 9 0 0112 21zM12 3a9 9 0 016.5 15.5A9 9 0 0112 3z" />
                </svg>
            </div>
            <h2 class="ml-2 text-sm font-semibold text-gray-800">
                Pays le plus visité
            </h2>
        </div>
        <p class="text-[#5E0035] font-medium text-lg">
            {{ $visitorStats['topCountry']->country ?? 'Aucune donnée' }}
        </p>
    </div>

    <!-- Carte : Total des visiteurs -->
    <div
        class="bg-gradient-to-br from-white to-indigo-50 p-3 rounded-lg shadow-sm border border-indigo-100 transform transition duration-200 hover:scale-105">
        <div class="flex items-center mb-2">
            <div class="bg-indigo-100 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    class="w-4 h-4 stroke-indigo-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <h2 class="ml-2 text-sm font-semibold text-gray-800">
                Total des visiteurs
            </h2>
        </div>
        <p class="text-indigo-600 font-medium text-lg">
            {{ $visitorStats['totalVisitors'] }}
        </p>
    </div>

    <!-- Carte : Visiteurs aujourd'hui -->
    <div
        class="bg-gradient-to-br from-white to-purple-50 p-3 rounded-lg shadow-sm border border-purple-100 transform transition duration-200 hover:scale-105">
        <div class="flex items-center mb-2">
            <div class="bg-purple-100 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    class="w-4 h-4 stroke-purple-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="ml-2 text-sm font-semibold text-gray-800">
                Visiteurs aujourd'hui
            </h2>
        </div>
        <p class="text-purple-600 font-medium text-lg">
            {{ $visitorStats['todayVisitors'] }}
        </p>
    </div>

    <!-- Carte : Total des devis -->
    <div
        class="bg-gradient-to-br from-white to-cyan-50 p-3 rounded-lg shadow-sm border border-cyan-100 transform transition duration-200 hover:scale-105">
        <div class="flex items-center mb-2">
            <div class="bg-cyan-100 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    class="w-4 h-4 stroke-cyan-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
            </div>
            <h2 class="ml-2 text-sm font-semibold text-gray-800">
                Total des devis
            </h2>
        </div>
        <p class="text-cyan-600 font-medium text-lg">
            {{ $quoteStats['totalQuotes'] }}
        </p>
    </div>

    <!-- Carte : Devis en attente -->
    <div
        class="bg-gradient-to-br from-white to-orange-50 p-3 rounded-lg shadow-sm border border-orange-100 transform transition duration-200 hover:scale-105">
        <div class="flex items-center mb-2">
            <div class="bg-orange-100 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    class="w-4 h-4 stroke-orange-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="ml-2 text-sm font-semibold text-gray-800">
                Devis en attente
            </h2>
        </div>
        <p class="text-orange-600 font-medium text-lg">
            {{ $quoteStats['pendingQuotes'] }}
        </p>
    </div>

    <!-- Carte : Total des expéditions -->
    <div
        class="bg-gradient-to-br from-white to-green-50 p-3 rounded-lg shadow-sm border border-green-100 transform transition duration-200 hover:scale-105">
        <div class="flex items-center mb-2">
            <div class="bg-green-100 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    class="w-4 h-4 stroke-green-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
            </div>
            <h2 class="ml-2 text-sm font-semibold text-gray-800">
                Total des expéditions
            </h2>
        </div>
        <p class="text-green-600 font-medium text-lg">
            {{ $shipmentStats['totalShipments'] }}
        </p>
    </div>

    <!-- Carte : Expéditions en traitement -->
    <div
        class="bg-gradient-to-br from-white to-teal-50 p-3 rounded-lg shadow-sm border border-teal-100 transform transition duration-200 hover:scale-105">
        <div class="flex items-center mb-2">
            <div class="bg-teal-100 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    class="w-4 h-4 stroke-teal-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
            </div>
            <h2 class="ml-2 text-sm font-semibold text-gray-800">
                Expéditions en traitement
            </h2>
        </div>
        <p class="text-teal-600 font-medium text-lg">
            {{ $shipmentStats['processingShipments'] }}
        </p>
    </div>

    <!-- Carte : Total des prises de contact -->
    <div
        class="bg-gradient-to-br from-white to-red-50 p-3 rounded-lg shadow-sm border border-red-100 transform transition duration-200 hover:scale-105">
        <div class="flex items-center mb-2">
            <div class="bg-red-100 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    class="w-4 h-4 stroke-red-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
            <h2 class="ml-2 text-sm font-semibold text-gray-800">
                Total des contacts
            </h2>
        </div>
        <p class="text-red-600 font-medium text-lg">
            {{ $contactStats['totalContacts'] }}
        </p>
    </div>

   
</div>
