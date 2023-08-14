<nav class="flex-row p-0 navbar fixed-top d-flex">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
    </div>
    <div class="flex-grow navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav w-100">
        <li class="nav-item w-100">

        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-format-line-spacing"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">

        <li class="nav-item dropdown d-none d-lg-block">

          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
            <h6 class="p-3 mb-0">Projects</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-file-outline text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="mb-1 preview-subject ellipsis">Software Development</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-web text-info"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="mb-1 preview-subject ellipsis">UI Development</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-layers text-danger"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="mb-1 preview-subject ellipsis">Software Testing</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <p class="p-3 mb-0 text-center">See all projects</p>
          </div>
          <li class="nav-item dropdown border-left">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <h6 class="p-3 mb-0">Notifications</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-calendar text-success"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="mb-1 preview-subject">Event today</p>
                  <p class="mb-0 text-muted ellipsis"> Just a reminder that you have an event today </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-settings text-danger"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="mb-1 preview-subject">Settings</p>
                  <p class="mb-0 text-muted ellipsis"> Update dashboard </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-link-variant text-warning"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="mb-1 preview-subject">Launch Admin</p>
                  <p class="mb-0 text-muted ellipsis"> New admin wow! </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <p class="p-3 mb-0 text-center">See all notifications</p>
            </div>

          </li>
        </li>
        <li>
<div class="hidden sm:flex sm:items-center sm:ml-6">
    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
        <div class="relative ml-3">
            <x-dropdown align="right" width="60">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                        {{ Auth::user()->currentTeam->name }}
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <div class="w-60">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>
                        <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                            {{ __('Team Settings') }}
                        </x-dropdown-link>
                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-dropdown-link href="{{ route('teams.create') }}">
                                {{ __('Create New Team') }}
                            </x-dropdown-link>
                        @endcan
                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200"></div>
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>
                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" />
                            @endforeach
                        @endif
                    </div>
                </x-slot>
            </x-dropdown>
        </div>
    @endif
    <div class="relative ml-3">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @else
                        {{ Auth::user()->name }}
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    @endif
                </button>
            </x-slot>
            <x-slot name="content">
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Account') }}
                </div>
                <x-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-dropdown-link>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-dropdown-link href="{{ route('api-tokens.index')}}">
                        {{ __('API Tokens') }}
                    </x-dropdown-link>
                @endif
                <div class="border-t border-gray-200"></div>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</div>

        </li>



    </div>
</nav>
<script src="build/assets/app-ab9fb1ca.js"></script>
