<aside>
    @php

    $routes = json_decode(json_encode([
        [
            'name' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'fa fa-dashboard'
        ],
        [
            'name' => 'Subscriptions',
            'route' => 'admin.subscriptions.index',
            'icon' => 'fa fa-dashboard'
        ],
        [
            'name' => 'Orders',
            'route' => 'admin.subscriptions.orders',
            'icon' => 'fa fa-dashboard'
        ],
        [
            'name' => 'Subjects',
            'icon' => 'fa fa-desktop',
            'sub'=> [
                [
                    'name' => 'List',
                    'route' => 'admin.subjects.index',
                    'icon' => 'fa fa-desktop',
                ],
                [
                    'name' => 'New',
                    'route' => 'admin.subjects.create',
                    'icon' => 'fa fa-desktop',
                ]
            ]
        ],
        [
            'name' => 'Academic Years',
            'icon' => 'fa fa-desktop',
            'sub'=> [
                [
                    'name' => 'List',
                    'route' => 'admin.academic-years.index',
                    'icon' => 'fa fa-desktop',
                ],
                [
                    'name' => 'New',
                    'route' => 'admin.academic-years.create',
                    'icon' => 'fa fa-desktop',
                ]
            ]
        ],
        [
            'name' => 'Lessons',
            'icon' => 'fa fa-desktop',
            'sub'=> [
                [
                    'name' => 'List',
                    'route' => 'admin.lessons.index',
                    'icon' => 'fa fa-desktop',
                ],
                [
                    'name' => 'New',
                    'route' => 'admin.lessons.create',
                    'icon' => 'fa fa-desktop',
                ]
            ]
        ],
        [
            'name' => 'Contact Us Messages',
            'route' => 'admin.contacts.index',
            'icon' => 'fa fa-dashboard'
        ],

    ]));
    @endphp
    <div id="sidebar" class="nav-collapse ">
      <!-- sidebar menu start-->
      <ul class="sidebar-menu" id="nav-accordion">
        <p class="centered"><a href="#"><img src="{{asset('adminLayout/img/ui-sam.jpg')}}" class="img-circle" width="80"></a></p>
        <h5 class="centered">Joe</h5>
        @foreach ($routes as $route)
            @isset($route->sub)
                <li class="sub-menu">
                    <a href="javascript:;" class="{{request()->routeIs(collect($route->sub)->pluck('route')) ? 'active' : ''}}">
                    <i class="{{$route->icon}}"></i>
                    <span>{{$route->name}}</span>
                    </a>
                    <ul class="sub">
                        @foreach ($route->sub as $sub)
                            <li>
                                <a href="{{route($sub->route)}}">
                                    <i class="{{$route->icon}}"></i>
                                    {{$sub->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="mt">
                    <a href="{{route($route->route)}}" class="{{request()->routeIs($route->route) ? 'active' : ''}}">
                    <i class="{{$route->icon}}"></i>
                    <span>{{$route->name}}</span>
                    </a>
                </li>
            @endisset
        @endforeach

      </ul>
      <!-- sidebar menu end-->
    </div>
  </aside>
