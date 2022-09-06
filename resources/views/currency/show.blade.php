<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center" id="app">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header text-white font-weight-bold bg-success">Currencies exchange from NBP
                    </div>
                    <div class="card-body">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col col-md-6"><b>Add Currency to you favourite list</b></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Currency</th>
                                        <th>Code</th>
                                        <th>Exchange</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $currency->name }}</td>
                                        <td>{{ $currency->code }}</td>
                                        <td>{{ $data[0]['mid'] }}</td>
                                        <td>
                                            <a href="{{ route('currency.index') }}"
                                                class="btn btn-warning btn-sm">Back</a>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
