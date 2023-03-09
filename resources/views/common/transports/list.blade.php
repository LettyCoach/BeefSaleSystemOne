<div class="">
    <table>
        <thead>
            <th>No</th>
            <th>load</th>
            <th>target</th>
            <th>registerNumber</th>
            <th>name</th>
            <th>birthday</th>
            <th>sex</th>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach($transportCompany->oxen as ox)
            <tr>
                <td>{{$counter++}}</td>
                <td>
                    <select name="" id="">
                        <option value="">mi</option>
                        <option value="">finish</option>
                    </select>
                </td>
                <td>target</td>
                <td>{{$ox->registerNumber}}</td>
                <td>{{$ox->name}}</td>
                <td>{{$ox->birtdday}}</td>
                <td>{{$ox->sex}}</td>
            </tr>
            @endforeach
        <tbody>
    </table>
</div>
