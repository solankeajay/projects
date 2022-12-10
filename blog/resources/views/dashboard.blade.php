@include("header")


<link itemprop="rel" rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">

<link itemprop="rel" rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

<div class="flex flex-wrap bg-white ">

    <div class=" mt-4 w-full lg:w-6/12 xl:w-4/12 px-5">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-4 xl:mb-0 shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total Student</h5>
                        <span class="font-semibold text-xl text-blueGray-700">{{ $total_student }}</span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-pink-500">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-blueGray-400 mt-4">
                    <!-- <span class="text-red-500 mr-2"><i class="fas fa-arrow-down"></i> 4,01%</span> -->
                    <span class="whitespace-nowrap"> In This System </span>
                </p>
            </div>
        </div>
    </div>

    <div class="mt-4 w-full lg:w-6/12 xl:w-4/12 px-5">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total Teacher</h5>
                        <span class="font-semibold text-xl text-blueGray-700">{{$total_teacher}}</span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-lightBlue-500">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-blueGray-400 mt-4">
                    <!-- <span class="text-red-500 mr-2"><i class="fas fa-arrow-down"></i> 1,25% </span> -->
                    <span class="whitespace-nowrap"> In This System </span>
                </p>
            </div>
        </div>
    </div>

    <div class="mt-4 w-full lg:w-6/12 xl:w-4/12 px-5 mb-4">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-3 xl:mb-0 shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-blueGray-400 uppercase font-bold text-xs"> Attend Student</h5>
                        <span class="font-semibold text-xl text-blueGray-700">{{$total_attend}}</span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-red-500">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-blueGray-400 mt-4">
                    <!-- <span class="text-emerald-500 mr-2"><i class="fas fa-arrow-up"></i> 2,99% </span> -->
                    <span class="whitespace-nowrap"> Today Attend Student Amount </span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white p-5">
    <p class="text-lg text-center font-bold m-5">Class Short Information</p>
    <table class="rounded-t-lg m-5 w-10/12 mx-auto bg-gray-200 text-gray-800">
        <tr class="text-left border-b-2 border-gray-300">
            <th class="px-4 py-3">#</th>
            <th class="px-4 py-3">Class Name</th>
            <th class="px-4 py-3">Student Amount</th>
            <th class="px-4 py-3">Daily Attendance %</th>
            <th class="px-4 py-3">Yearly Attendance %</th>
        </tr>

        @foreach($class_details as $class)
        <tr class="bg-gray-100 border-b border-gray-200">
            <td class="px-4 py-3">{{$class->id}}</td>
            <td class="px-4 py-3">{{$class->class_title}}</td>
            <td class="px-4 py-3">{{$class->total_student}}</td>
            <td class="px-4 py-3">{{$class->daily_attendance}}</td>
            <td class="px-4 py-3">{{$class->yearly_attendance}}</td>
        </tr>
        @endforeach
    </table>
</div>
<!-- classic design -->




@include("footer")