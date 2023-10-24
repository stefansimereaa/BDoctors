<script>
export default {
  name: 'Header',
  data: () => ({ doctors: [] }),
}
</script>

<template>
  <header>
    <nav class="navbar navbar-expand-lg" id="navbar">
      <div class="d-flex justify-content-between nav-box w-100">
        <!-- Logo Img -->
        <figure class="px-4 d-flex justify-content-center image-container">
          <img src="../assets/img/logo_Bdoctor.png" alt="logo Bdoctor">
        </figure>
        <!-- Links Navbar -->
        <div class="d-flex px-4">
          <div class="navbar navbar-links" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active d-min me-3" aria-current="page" href="http://localhost:5174/">Home</a>
              <a class="nav-link active d-min me-3" aria-current="page" href="#doctor-list">Dottori</a>
              <a class="nav-link active d-min me-3" aria-current="page" href="#reviews-box">Recensioni</a>
              <a class="nav-link active d-min me-3" aria-current="page" href="#contatti">Contatti</a>
              <div class="d-flex align-items-center">
                <a class="nav-link login-btn text-white btn-nav" href="http://127.0.0.1:8000/login">Login</a>
                <a class="nav-link  text-white btn-nav" href="http://127.0.0.1:8000/register">Sei un Professionista
                  sanitario?</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<style scoped>
header {
  height: 200px;
  width: 100%;
}


.nav-link.active:hover {
  position: relative;
}

.nav-link.active:hover::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 3px;
  background-color: #04D8C5;
  bottom: -5px;
  left: 0;
}

.image-container {
  padding: 0px;
  margin: 0px;
}

.nav-link {
  padding: 0;
}

.navbar {
  height: 100px;
}

.nav-box {
  height: 100px;
}

/* Logo Navbar */
img {
  max-width: 100px;
}

.d-min {
  display: none;
}

.navbar-nav {
  display: flex;
  align-items: center;
  flex-direction: row;
}


/* Buttons Navbar */
.btn-nav {
  border-radius: 10px;
  margin-left: 20px;
  background-color: #04D8C5;
  padding: 10px 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
  box-shadow: 0px 5px 8px #888888;
  transition: background-color 1s, box-shadow 1s, scale 1s;
}

.btn-nav:hover {
  color: white;
  background-color: #04D8C5;
  box-shadow: 0px 9px 11px #888888;

  scale: 1.1;
}




@media screen and (min-width: 580px) {
  .nav {
    justify-content: space-around;
  }
}

@media screen and (min-width: 780px) {
  li {
    padding-right: 20px;
  }

  .d-min {
    display: block;
  }
}
</style>
