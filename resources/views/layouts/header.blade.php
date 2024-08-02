<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{url('posts')}}">Blog Post</a>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('posts')}}">Posts</a>
          </li>
        </ul>
        <div id="notifications" class="position-relative me-4">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="notificationButton" data-bs-toggle="dropdown" aria-expanded="false">
                Notifications <span class="badge bg-danger" id="notificationCount">0</span>
            </button>
            <div id="notificationList" class="dropdown-menu dropdown-menu-end">
                <div class="dropdown-item-text">No notifications</div>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
      </div>
    </div>
</nav>