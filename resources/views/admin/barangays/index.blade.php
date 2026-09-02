@extends('layouts.app')

@section('title', 'Barangays')

@section('content')

    <div class="space-y-6">
            
        {{-- Search & Filters --}}
        <x-card>

            <div class="flex grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-overview_card
                    icon="ti ti-building-bank"
                    label="Barangays"
                    total="2"
                    color="blue"
                />

                <x-overview_card
                    icon="ti ti-circle-dashed-x"
                    label="Available Slot"
                    total="Slot"
                    color="gray"
                />
            </div> 
            
            <div class="border-t border-gray-200 mt-4 mb-4"></div>

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex w-full flex-col gap-2 sm:flex-row sm:items-center lg:w-auto">

                    {{-- Search --}}
                    <x-input_white
                        name="search"
                        type="text"
                        placeholder="Search by name or id"
                        icon="ti ti-search"
                        class="w-full sm:w-[20rem]"
                    />

                    {{-- Search Button --}}
                    <x-button
                        color="d-blue"
                        type="button"
                        class="w-full lg:inline-flex sm:w-auto text-xs"
                    >
                        Search
                    </x-button>


                </div>

                {{-- Desktop Add Staff --}}
                <x-button
                    color="d-blue"
                    type="button"
                    icon="ti ti-building-plus"
                    class="hidden h-10 lg:inline-flex lg:w-auto text-xs"
                >
                    Add Barangay
                </x-button>

            </div>

        </x-card>


        {{-- Barangay Table --}}
        <x-card>

            <x-table
                :columns="[
                    'ID',
                    'Barangay',
                    'Representative',
                ]"
                :actions="true"
            >

                <x-slot:body>

                    <tr class="border-b border-gray-100 transition-colors hover:bg-gray-50">
                        <td class="whitespace-nowrap px-4 py-3 text-gray-900">
                            BRGY-00001
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-gray-900">
                            Barangay Amihan
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-gray-900">
                            Galanida, Filemon Jr., L.
                        </td>

                        <td class="px-4 py-3">
                            <x-action_btn
                                icon="ti ti-eye"
                                color="blue"
                                title="View Barangay"
                            />
                        </td>
                    </tr>

                    <tr class="border-b border-gray-100 transition-colors hover:bg-gray-50">
                        <td class="whitespace-nowrap px-4 py-3 text-gray-900">
                            BRGY-00002
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-gray-900">
                            Barangay Lireo
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-gray-900">
                            Hagorn.
                        </td>

                        <td class="px-4 py-3">
                            <x-action_btn
                                icon="ti ti-eye"
                                color="blue"
                                title="View Staff"
                            />
                        </td>
                    </tr>
                    

                </x-slot:body>

            </x-table>

        </x-card>

    </div>


    <!-- {{-- Mobile Floating Add Staff --}}
    <div class="fixed bottom-5 right-5 z-50 lg:hidden">

        <x-button
            color="d-blue"
            type="button"
            icon="ti ti-user-plus"
            class="h-12 rounded-full px-5 shadow-lg"
        >
            Add Staff
        </x-button>

    </div> -->

@endsection
