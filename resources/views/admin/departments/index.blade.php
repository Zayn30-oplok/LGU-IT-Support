@extends('layouts.app')

@section('title', 'Departments')

@section('content')
    <div class="space-y-6">
            
        {{-- Search & Filters --}}
        <x-card>

            <div class="flex grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-overview_card
                    icon="ti ti-building"
                    label="Departments"
                    total="2"
                    color="blue"
                />

                <x-overview_card
                    icon="ti ti-key"
                    label="Active Keys"
                    total="1"
                    color="green"
                />

                <x-overview_card
                    icon="ti ti-key-off"
                    label="Disabled Keys"
                    total="1"
                    color="red"
                />
            </div> 
            
            <div class="border-t border-gray-200"></div>

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
                        class="h-10 w-full lg:inline-flex sm:w-auto text-xs"
                    >
                        Search
                    </x-button>

                    {{-- Status --}}
                    <x-dropdown
                        name="status"
                        placeholder="All Statuses"
                        :options="[
                            'active' => 'Active',
                            'disabled' => 'Disabled',
                        ]"
                        class="w-full sm:ml-4 sm:w-[10rem]"
                    />


                </div>

                {{-- Desktop Add Staff --}}
                <x-button
                    color="d-blue"
                    type="button"
                    icon="ti ti-building-plus"
                    class="hidden h-10 lg:inline-flex lg:w-auto text-xs"
                >
                    Add Department
                </x-button>

            </div>

        </x-card>


        {{-- Staff Table --}}
        <x-card>

            <x-table
                :columns="[
                    'ID',
                    'Department',
                    'Key Status',
                ]"
                :actions="true"
            >

                <x-slot:body>


                    <tr class="border-b border-gray-100 transition-colors hover:bg-gray-50">
                        <td class="whitespace-nowrap px-4 py-3 text-gray-900">
                            DEPT-00001
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-gray-900">
                            CDRRMO
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-gray-900">
                            <x-badge
                                color="red"
                            >
                                Disabled
                            </x-badge>
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center gap-1.5">
                                <x-action_btn
                                    icon="ti ti-refresh"
                                    color="blue"
                                    title="Update Department"
                                />
                            </div>
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