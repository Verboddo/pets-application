<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Type</th>
                            <th>Adres</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->getData() as $value)
                        <tr>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->type }}</td>
                            <td>{{ $value->address }}</td>
                            <td>
                                <a
                                    href=""
                                    class="delete-pet"
                                    data-url="{{ route('pet.delete', $value->id) }}"
                                    data-id="{{ $value->id }}"
                                    >Verwijderen
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <!-- Toon de paginering -->
                @if ($pets->lastPage() > 1)
                {{ $pets->links() }}
                @endif
            </div>
        </div>
    </div>
</div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th >Type</th>
                            <th >Aantal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($counted->getData() as $key => $data)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $data }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
