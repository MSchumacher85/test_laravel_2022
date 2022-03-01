@if($model)
<table class="table table-dark table-striped mt-8">

    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
    </tr>
    </thead>

    <tbody>
    @foreach($model as $item)
        <tr>
            <th scope="row">{{$item['id']}}</th>
            <td>{{$item['name']}}</td>
            <td>{{$item['phone']}}</td>
            <td>{{$item['email']}}</td>
        </tr>
    @endforeach
    </tbody>

</table>
@else
    <div class="alert alert-danger mt-8" role="alert">
        Контакты не найдены
    </div>
@endif

