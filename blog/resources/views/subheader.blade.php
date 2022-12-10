<div id="manu-bar">
    <div class="container pt-1 pb-1">
        <div class="row">

            <div class="col-6">

                <a class="btn btn-primary" href="./{{$route}}">All Data</a>

            </div>

            <div class="col-6 d-flex flex-row justify-content-end">
                <!-- <div></div> -->
                <!-- <select name="filter" class="form-select" onchange="location = this.value;">
                    <option disable value="">Filter By Class</option>

                    <option value="{{ route($route, ['filter' => 1]) }}">1</option>
                    <option value="{{ route('Home', ['filter' => 2]) }}">2</option>
                    <option value="{{ route('Home', ['filter' => 3]) }}">3</option>
                    <option value="{{ route('Home', ['filter' => 4]) }}">4</option>
                    <option value="{{ route('Home', ['filter' => 5]) }}">5</option>
                    <option value="{{ route('Home', ['filter' => 6]) }}">6</option>
                    <option value="{{ route('Home', ['filter' => 7]) }}">7</option>
                    <option value="{{ route('Home', ['filter' => 8]) }}">8</option>
                    <option value="{{ route('Home', ['filter' => 9]) }}">9</option>
                    <option value="{{ route('Home', ['filter' => 10]) }}">10</option>
                </select> -->
                @if($route == 'Timetable' || $route == 'Subject' || $route == 'Home' || $route == 'Attendance')


                <select name="filter" class="form-select" onchange="location = this.value;">
                    <option disable value="">Filter By Class</option>

                    @foreach ($class as $class)
                    <option value="{{ route($route, ['filter' => $class->id]) }}">{{ $class->class_title }}</option>
                    @endforeach
                </select>

                @endif

                <select name="sort" class="form-select" onchange="location = this.value;">
                    <option value="">Sort By</option>
                    @foreach ($sort_by as $sort_name => $sort_value)
                    <option value="{{ route($route, ['sort' => $sort_value]) }}">{{$sort_name}}</option>
                    <!-- <option value="{{ route($route, ['sort' => 'class']) }}">Class</option> -->
                    @endforeach
                </select>

                <form class="d-flex" action="./{{$route}}" method="get">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>

            </div>
        </div>
    </div>
</div>