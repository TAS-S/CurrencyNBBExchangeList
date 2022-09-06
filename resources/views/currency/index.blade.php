<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Currency App') }}
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
                                    <div class="col col-md-6">
                                        <a href="{{ route('currency.create') }}"
                                            class="btn btn-success btn-sm float-end">Select Currency</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Currency</th>
                                        <th>Code</th>
                                        <th>Action</th>
                                    </tr>
                                    @if(count($currency) > 0)
                        
                                        @foreach($currency as $row)
                        
                                            <tr>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->code }}</td>
                                                <td>
                                                    <form method="post" action="{{ route('currency.destroy', $row->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('currency.show', $row->id) }}" class="btn btn-primary btn-sm">View</a>
                                                        <a href="{{ route('currency.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                                                                                
                                                        <input type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" style="background-color: red" value="Delete" data-toggle="tooltip" title='Delete'>
                                                        
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                        
                                        @endforeach
                        
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No Data Found</td>
                                        </tr>
                                    @endif
                                </table>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
