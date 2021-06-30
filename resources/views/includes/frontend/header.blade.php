<!-- Side Bar -->
        <div class="side-menu" id="sidebar-menu">
            <div class="close-btn"><span class="material-icons">close</span></div>
            <div class="side-menu" id="sidebar-menu">
                <ul>
                    <li class="py-4">
                        <img alt="" src="{{ asset('frontend/img/logo.png') }}">
                    </li>
                    <li>
                        <a class="panel-close" href="{{ route('beranda') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="submenu">
                        <a href="#"><span>Absensi</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="panel-close" href="{{ route('absen.index') }}"> Lihat Kehadiran Saya</a></li>
                            {{-- <li><a class="panel-close" href="{{ route('') }}"> Catat Perjalanan Dinas</a></li> --}}
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><span>Cuti</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="panel-close" href="{{ route('cuti.create') }}"> Pengajuan Cuti</a></li>
                            <li><a class="panel-close" href="{{ route('cuti.index') }}"> Lihat Daftar Cuti</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><span>Aktivitas</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="panel-close" href="{{ route('aktivitas.create') }}"> Catat Aktivitas</a></li>
                            <li><a class="panel-close" href="{{ route('aktivitas.index') }}"> Lihat Aktivitas Saya</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><span>BBM</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="panel-close" href="{{ route('bensin.create') }}"> Ajukan Pengisian BBM</a></li>
                            <li><a class="panel-close" href="{{ route('bensin.index') }}"> Lihat Catatan BBM Saya</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="panel-close" href="{{ route('profil') }}">
                            Profil
                        </a>
                    </li>
                    <li>
                        <button class="btn btn-danger btn-block"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar
                        </button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /Side Bar -->
