<nav class="navbar navbar-expand-lg navbar-light bg-info py-3 px-5 fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-white" href="{{ route('showRumahSakit') }}">Sistem Informasi RS</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-white fw-bold" aria-current="page" href="{{ route('showRumahSakit') }}">Rumah Sakit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fw-bold" href="{{ route('showPasien') }}">Pasien</a>
        </li>
      </ul>
    </div>
  </div>
</nav>