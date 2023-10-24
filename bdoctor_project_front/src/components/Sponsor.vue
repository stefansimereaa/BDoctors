<script >
// import axios from 'axios';
// const endpoint = 'http://127.0.0.1:8000/api/';
export default {
  name: 'Sponsor',
  // data: () => ({
  //   doctors: [],
  //   sponsored: [],
  //   totSponsored:0,

  // }),
  // methods: {
  //   fetchDoctors() {
  //     axios.get(endpoint + 'doctors').then(res => { this.doctors = res.data })
  //     this.doctors.forEach((doctor) => {
  //       if (doctor.sponsor) {
  //         this.sponsored.push(doctor)
  //       }
  //     })
  //     this.totSponsored=this.sponsored.length;
  //   },
  // },
  // created() {
  //   this.fetchdoctors()
  // }
}
</script>

<template>
  <div class="sponsor-box text-center">
    <div class="buttons-banner">
      <a href="http://127.0.0.1:8000/register" class="left-button">Registrati</a>
      <a href="http://127.0.0.1:8000/register" class="left-button">Sponsor</a>
    </div>
  </div>
</template>

<style scoped>
a {
  text-decoration: none;
  color: black;
}

.sponsor-box {
  position: relative;
  height: 500px;
  margin-top: 70px;
  color: white;
  background-image: url(../assets/img/banner.png);
  background-position: 0px -20px;
  background-size: cover;
}

.buttons-banner {
  position: absolute;
  bottom: 50px;
  left: 90px;
}

.left-button {
  border: 0;
  color: white;
  padding: 17px 38px;
  background-color: #03C3A5;
  border-radius: 15px;
  font-size: 20px;
  margin-right: 35px;
  margin-bottom: 10px;
  box-shadow: 0 0 10px 2px rgba(255, 255, 255, 0.6);
  transition: background-color 0.5s, box-shadow 0.5s;
}

.left-button:hover {
  background-color: #04D8C5;
  box-shadow: 0 0 35px 7px rgba(255, 255, 255, 0.6);
}
</style>
