<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                    <i class="ti ti-bell-ringing"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank"
                    class="btn btn-primary">Download Free</a>
                <li class="nav-item dropdown">
                    @php
    $user = Auth::user(); // Get the authenticated user
    $userName = $user->name; // Get the user's name
    $initials = strtoupper(implode('', array_map(function($word) { return $word[0]; }, explode(' ', $userName)))); // Generate initials from the name
    $initials = substr($initials, 0, 2); // Get only the first 2 characters of initials
    $imageUrl = $user->profile_image ? asset('storage/'.$user->profile_image) : asset('template/assets/images/profile/user-1.jpg'); // Use the profile image or fallback
@endphp

<a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
    @if($user->profile_image && file_exists(public_path('storage/'.$user->profile_image)))
        <!-- Display user's image if exists -->
        <img src="{{ $imageUrl }}" alt="Profile Image" width="35" height="35" class="rounded-circle">
    @else
        <!-- Fallback to initials if no image exists -->
        <div style="width: 35px; height: 35px; background-color: #ccc; color: #fff; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
            {{ $initials }}
        </div>
    @endif
</a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-mail fs-6"></i>
                                <p class="mb-0 fs-3">My Account</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-list-check fs-6"></i>
                                <p class="mb-0 fs-3">My Task</p>
                            </a>
                            <a href="javascript:void(0)"
   id="logout-link"
   class="btn btn-outline-primary mx-3 mt-2 d-block">
    Logout
</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<script>
    document.getElementById('logout-link').addEventListener('click', function() {
        document.getElementById('logout-form').submit();
    });
</script>
