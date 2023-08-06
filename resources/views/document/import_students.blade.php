<form method="post" action="{{ route('students.import') }}" enctype="multipart/form-data">
    @csrf
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @if (isset($errors) && $errors->any())
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    @endif
    @if (session()->has('failures'))
        <table>
            <tr>
                <th>Row</th>
                <th>Attribut</th>
                <th>Errors</th>
                <th>Value</th>
            </tr>
            @foreach (session()->get('failures') as $err)
                <tr>
                    <td>{{ $err->row() }}</td>
                    <td>{{ $err->attribute() }}</td>
                    <td>
                        <ul>
                            @foreach ($validation->errors() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $validation->value()[$validation->attribute()] }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    <div class="modal-content">
        <div class="modal-body">
            <label>Pilih file excel</label>
            <div class="form-group">
                <input type="file" name="file" required="required">
            </div>
        </div>
        <div class="modal-body">
            <label>mulai baris ke</label>
            <div class="form-group">
                <input type="number" name="start" required="required">
            </div>
        </div>
        <div class="modal-body">
            <label>Limit</label>
            <div class="form-group">
                <input type="number" name="limit" required="required">
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
        </div>
        <p>Terakhir : {{ $terbaru->nama }}</p>

    </div>
</form>
