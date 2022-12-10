@include('header')

<link itemprop="rel" rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">

<link itemprop="rel" rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">


<div style="padding-bottom: 15rem;" class="bg-white pt-2">
    <p class="text-lg text-center font-bold m-5">Class Student Information</p>
    <table class="rounded-t-lg m-5 w-10/12 mx-auto bg-gray-200 text-gray-800">
        <tr class="text-left border-b-2 border-gray-300">
            <th class="px-4 py-3">#</th>
            <th class="px-4 py-3">Student Name</th>
            <th class="px-4 py-3">Gander</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Address</th>
            <th class="px-4 py-3">Date Of Birth</th>
            <th class="px-4 py-3">Phone</th>
            <th class="px-4 py-3">Category</th>
        </tr>

        @foreach($student as $students)
        <tr class="bg-gray-100 border-b border-gray-200">
            <td class="px-4 py-3">{{$students->id}}</td>
            <td class="px-4 py-3">{{$students->f_name .' '.$students->l_name}}</td>
            <td class="px-4 py-3">{{$students->gander}}</td>
            <td class="px-4 py-3">{{$students->email}}</td>
            <td class="px-4 py-3">{{$students->address}}</td>
            <td class="px-4 py-3">{{$students->DOB}}</td>
            <td class="px-4 py-3">{{$students->mobile_number}}</td>
            <td class="px-4 py-3">{{$students->category}}</td>
        </tr>
        @endforeach
    </table>
</div>
<!-- classic design -->


@include('footer')