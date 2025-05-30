<section class="py-8 px-4 bg-gray-50">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">
                        Community Post Statistics
                    </h2>

                    <div class="grid grid-cols-3 gap-4 sm:gap-6">
                        {{-- Total Approved Posts --}}
                        <a href="{{ route('news') }}"
                            class="block rounded-xl border-2 border-blue-200 bg-blue-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-blue-600">
                                    {{ number_format($totalPublishedPosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-blue-600">
                                    News Post
                                </h3>
                            </div>
                        </a>


                        {{-- Caveat Posts --}}
                        <a href="{{ route('caveat.posts') }}"
                            class="block rounded-xl border-2 border-green-200 bg-green-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-green-600">
                                    {{ number_format($totalCaveatPostsData) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-green-600">
                                    Caveat Posts
                                </h3>
                            </div>
                        </a>

                        {{-- Remembrance Posts --}}
                        <a href="{{ route('list-remembrance') }}"
                            class="block rounded-xl border-2 border-green-200 bg-green-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-green-600">
                                    {{ number_format($totalRemembrancePosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-green-600">
                                    Remembrance Posts
                                </h3>
                            </div>
                        </a>

                        {{-- Public Notices --}}
                        <a href="{{ route('lists-public-notice') }}"
                            class="block rounded-xl border-2 border-red-200 bg-red-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-red-600">
                                    {{ number_format($totalPublicNoticePosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-red-600">
                                    Public Notices
                                </h3>
                            </div>
                        </a>

                        {{-- Lost and Found --}}
                        <a href="{{ route('lists-lost-and-found') }}"
                            class="block rounded-xl border-2 border-purple-200 bg-purple-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-purple-600">
                                    {{ number_format($totalLostAndFoundPosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-purple-600">
                                    Lost and Found
                                </h3>
                            </div>
                        </a>

                        {{-- Obituaries --}}
                        <a href="{{ route('obituary.listObituaryPosts') }}"
                            class="block rounded-xl border-2 border-yellow-200 bg-yellow-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-yellow-600">
                                    {{ number_format($totalObituaryPosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-yellow-600">
                                    Obituaries
                                </h3>
                            </div>
                        </a>

                        {{-- Missing Persons --}}
                        <a href="{{ route('missing-wanted-lists.details') }}"
                            class="block rounded-xl border-2 border-indigo-200 bg-indigo-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-indigo-600">
                                    {{ number_format($totalMissingPersonPosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-indigo-600">
                                    Missing &amp; Wanted Persons
                                </h3>
                            </div>
                        </a>

                        {{-- Wanted Persons --}}
                        {{-- <a href="#}"
                            class="block rounded-xl border-2 border-pink-200 bg-pink-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-pink-600">
                                    {{ number_format($totalWantedPersonPosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-pink-600">
                                    Wanted Persons
                                </h3>
                            </div>
                        </a> --}}

                        {{-- Change of Name --}}
                        <a href="{{ route('list-change-of-name') }}"
                            class="block rounded-xl border-2 border-teal-200 bg-teal-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-teal-600">
                                    {{ number_format($totalChangeOfNamePosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-teal-600">
                                    Change of Name
                                </h3>
                            </div>
                        </a>

                        {{-- Birthday  --}}
                        <a href="{{ route('list.birthday-posts') }}"
                            class="block rounded-xl border-2 border-cyan-200 bg-gray-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-brown-600">
                                    {{ number_format($totalBirthdayPosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-teal-600">
                                    Birthday Posts
                                </h3>
                            </div>
                        </a>

                        {{-- Wedding --}}
                        <a href="{{ route('lists.wedding') }}"
                            class="block rounded-xl border-2 border-orange-200 bg-teal-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-teal-600">
                                    {{ number_format($totalWeddingPosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-teal-600">
                                    Wedding Posts
                                </h3>
                            </div>
                        </a>

                        {{-- Child-dedication --}}
                        <a href="{{ route('list.dedication') }}"
                            class="block rounded-xl border-2 border-indigo-200 bg-teal-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-teal-600">
                                    {{ number_format($totalChildDedicationPosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-teal-600">
                                    Child-Dedication Posts
                                </h3>
                            </div>
                        </a>

                        {{-- Stolen Vehicle --}}
                        <a href="{{ route('list-stolen-vehicles') }}"
                            class="block rounded-xl border-2 border-pink-200 bg-teal-50 p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2 text-teal-600">
                                    {{ number_format($totalStolenVehiclePosts) }}
                                </div>
                                <h3 class="text-xs font-medium uppercase tracking-wider text-teal-600">
                                    Stolen Vehicle Posts
                                </h3>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
