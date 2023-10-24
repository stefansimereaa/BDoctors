<script >
export default {
  name: 'Footer',
  data: () => ({}),
}
</script>

<template>
  <div class="footer-box" id="contatti">
    <!-- CONTACTS -->
    <div class="d-flex justify-content-center">
      <div class="d-flex ms-3 pt-5">
        <div class="contacts me-5">
          <!-- CONTACTS -->
          <ul>
            <h2>Contatti</h2>
            <li><a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=matteo.pizzichemi01@gmail.com" target="_blank">Matteo</a></li>
            <li><a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=gio.cvll16@gmail.com" target="_blank">Gioele</a></li>
            <li><a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=tobola92@gmail.com" target="_blank">Patric</a></li>
            <li><a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=giacomo.p03@gmail.com" target="_blank">Giacomo</a></li>
            <li><a  href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=stefanosimerea15@gmail.com" target="_blank">Stefan</a></li>
          </ul>
        </div>
        <div class="socials me-5">
          <h2>Socials</h2>
          <!-- SOCIALS -->
          <ul>
            <li><a href="https://www.linkedin.com/in/matteo-pizzichemi-5b1398256/" target="_blank">Matteo</a></li>
            <li><a href="https://www.linkedin.com/in/gioele-iacovella-8a1ab2291/" target="_blank">Gioele</a></li>
            <li><a href="https://www.linkedin.com/in/patric-tobola/" target="_blank">Patric</a></li>
            <li><a href="https://www.linkedin.com/in/giacomo-portaluppi-19a94628b/" target="_blank">Giacomo</a></li>
            <li><a href="https://www.linkedin.com/in/stefan-simerea-929794291/" target="_blank">Stefan</a></li>
          </ul>
        </div>
      </div>
      <div class="sponsor-box me-5">
        <h2 class="sponsor ">Sponsor</h2>
        <!-- SPONSOR -->
        <ul>
          <li><a href="https://boolean.careers/" target="_blank">Boolean</a></li>
          <li><a href="https://github.com/matteo2302/Matteo-Pizzichemi" target="_blank">Matteo</a></li>
            <li><a href="https://github.com/GLCVLL" target="_blank">Gioele</a></li>
            <li><a href="https://github.com/patrictobola" target="_blank">Patric</a></li>
            <li><a href="https://github.com/Gino804/Giacomo_Portaluppi" target="_blank">Giacomo</a></li>
            <li><a href="https://github.com/stefansimereaa" target="_blank">Stefan</a></li>
        </ul>
      </div>
    </div>
    <p class="text-center pt-5">Prenota la tua visita online! </p>
  </div>
</template>

<style scoped>
.footer-box {
  width: 100%;
  height: 580px;
  color: white;
  margin-top: 90px;
  background-image: url(../assets/img/bannerfooter.png);
}

ul {
  list-style: none;
  padding: 0px;
}

.sponsor-box {
  margin-left: 20px;
}

.sponsor {
  margin-top: 48px;
}

.socials {
  margin-left: 80px;
}

a {
  text-decoration: none;
  color: white;
}

a:hover {
  text-decoration: none; 
  border-bottom: 2px solid #20c997; 
}

@media screen and (min-width: 580px) {
  .footer-box {
    height: 400px;

  }

  .media580 {
    display: flex;
  }


  .sponsor-box {
    margin-left: 80px;
  }
}
</style>