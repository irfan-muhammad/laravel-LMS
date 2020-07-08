@component('mail::message')
# Cosures Listing

Your order has been shipped!

@component('mail::button', ['url' => $url])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent




 <table class="table table-hover table-bordered" id="sampleTable">
    <thead>
        <tr>
            <th> # </th>


            <th class="text-center"> Title </th>
            <th class="text-center"> Category </th>
            <th class="text-center"> Duration </th>
            <th class="text-center"> credits </th>
            <th class="text-center"> lectures </th>
            <th class="text-center"> classdays </th>
            <th class="text-center"> Active </th>

        </tr>
    </thead>
    <tbody>
    <?php $counter=0;?>
        @foreach($courses as $course)

            <?php $counter++;?>
                <tr>
                    <td>{{ $counter }}</td>
                    <td class="text-center">{{ $course->title }}</td>
                    <td class="text-center">{{ $course->category->name }}</td>
                    <td class="text-center">{{ $course->duration }}</td>


                    <td class="text-center">{{ $course->credits}}</td>
                    <td class="text-center">{{ $course->lectures}}</td>
                    <td class="text-center">{{ $course->classdays}}</td>

                    <td class="text-center">
                        @if ($course->active == 1)
                            <span class="badge badge-success">Yes</span>
                        @else
                            <span class="badge badge-danger">No</span>
                        @endif
                    </td>


                </tr>

        @endforeach
    </tbody>
</table>
