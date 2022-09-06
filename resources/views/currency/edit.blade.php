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

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('currency.update', $currency->id) }}" method="POST"
                            enctype="multipart/form-data" id="form">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label class="form-label">Select your list of currencies: </label>
                                <select name="currency_id[]" class="select2-multi form-select" multiple="multiple"
                                    style="width: 100%">

                                    @foreach ($currencyAll as $item)
                                        @if (in_array($item->id, $selected_currencies))
                                            <option value="{{ $item->id }}" selected="true">
                                                {{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <button class="btn btn-info" type="submit">Accept</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
