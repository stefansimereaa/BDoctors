<script >
import axios from 'axios';
import { adjust, fill } from 'fontawesome';
const endpoint = 'http://127.0.0.1:8000/api/';

export default {
  name: 'DoctorList',

  data: () => ({
    specializations: [],
    doctors: [],
    specializationFilter: 0,
    averageFilter: 0,
    reviewsFilter: 0,
    links: null,
  }),

  watch: {
    specializationFilter(newVal) {
      switch (newVal) {
        case '1':
          this.$router.push('/ginecologo');
          break;
        case '2':
          this.$router.push('/ortopedico');
          break;
        case '3':
          this.$router.push('/dermatologo');
          break;
        case '4':
          this.$router.push('/nutrizionista');
          break;
        case '5':
          this.$router.push('/psicologo');
          break;
        case '6':
          this.$router.push('/oculista');
          break;
        case '7':
          this.$router.push('/urologo');
          break;
        case '8':
          this.$router.push('/otorino');
          break;
        case '9':
          this.$router.push('/cardiologo');
          break;
        case '10':
          this.$router.push('/dentista');
          break;
        default:
          this.$router.push('/');
          break;
      }
    },
    // Watch for changes in the route and update the select value
  },

  methods: {
    getOptionFromRoute(route) {
      if (route === '/ginecologo') {
        return '1';
      } else if (route === '/ortopedico') {
        return '2';
      } else if (route === '/dermatologo') {
        return '3';
      } else if (route === '/nutrizionista') {
        return '4';
      } else if (route === '/psicologo') {
        return '5';
      } else if (route === '/oculista') {
        return '6';
      } else if (route === '/urologo') {
        return '7';
      } else if (route === '/otorino') {
        return '8';
      } else if (route === '/cardiologo') {
        return '9';
      } else if (route === '/dentista') {
        return '10';
      } else {
        return null;
      }
    },
    fillSpecialization() {
      const selectedOption = this.getOptionFromRoute(this.$route.path);
      if (selectedOption !== null) {
        this.specializationFilter = selectedOption;
      }
    },

    fetchSpecializations() {
      axios.get(endpoint + 'specializations').then(res => { this.specializations = res.data })
    },

    fetchDoctors(uri = endpoint + 'doctors') {
      axios.get(uri).then(res => {
        this.doctors = res.data.data
        this.links = res.data.links
      })
    },

    fetchFilteredDoctors() {
      this.doctors = [];
      let newDoctors = [];

      // Se nessun filtro è attivo
      if (!this.specializationFilter && !this.averageFilter) {
        axios.get(endpoint + 'doctors').then(res => {
          newDoctors = res.data.data;
          this.links = res.data.links
          if (this.reviewsFilter) this.doctors = this.orderDoctorsByReviews(newDoctors);
          else this.doctors = newDoctors;
        })
      }

      // Se è attivo solo il filtro delle specializzazioni
      else if (this.specializationFilter && !this.averageFilter) {

        if (this.specializationFilter == '0') {
          axios.get(endpoint + 'doctors').then(res => {
            newDoctors = res.data.data;
            this.links = res.data.links
            if (this.reviewsFilter != '0') this.doctors = this.orderDoctorsByReviews(newDoctors);
            else this.doctors = newDoctors;
          })
        }
        else {
          axios.get(endpoint + 'doctors/specialization/' + this.specializationFilter).then(res => {
            let flag = 0;
            res.data.data.forEach((doctor) => {
              doctor.specializations.forEach((specialization) => {
                if (specialization.id == this.specializationFilter) flag = 1;
              })
              if (flag) {
                newDoctors.push(doctor);
                this.links = res.data.links
                flag = 0;
              }
            })
            if (this.reviewsFilter != '0') this.doctors = this.orderDoctorsByReviews(newDoctors);
            else this.doctors = newDoctors;
          })
        }
      }
    },

  },

  mounted() {
    this.urlRoute = this.$route.path;
    this.fillSpecialization();
    this.fetchSpecializations();
    if (this.specializationFilter !== 0) {
      this.fetchFilteredDoctors()
    } else this.fetchDoctors();
  }

}
</script>

<template>
  <!-- DOCTORS -->
  <div class="doctors-box">
    <div class="d-flex justify-content-between">
      <h1>Medici in Evidenza:</h1>
    </div>

    <form class="filetform">
      <!-- Filtro specializzazione -->
      <div class="my-2"><label for="specialization">Specializzazione: </label>
        <select class="ms-2" id="specialization" v-model="specializationFilter" @change="fetchFilteredDoctors()">
          <option value="0">Seleziona...</option>
          <option v-for="specialization in specializations" :key="specialization.id"
            :value="specialization.id.toString()">
            {{ specialization.name }}</option>
        </select>
      </div>
    </form>

    <!-- DOCTOR LIST -->
    <ul class="doctor-list" id="doctor-list">
      <!-- DOCTOR CARD -->
      <li v-for="doctor in doctors" :key="doctor.id">
        <RouterLink :to="{ name: 'profile', params: { id: doctor.id } }">
          {{ console.log(doctor) }}
          <div class="doctor">
            <!-- DOCTOR-IMG -->
            <div class="d-flex justify-content-between">
              <div class="doc-image mb-3">
                <img v-if="doctor.profile_photo" :src="doctor.profile_photo">
                <img v-else src="../assets/img/placeholder.jpg">
              </div>
              <div class="sponsor-badge">
                <img v-if="doctor.sponsors.length" src="../assets/img/s (1).png" alt="sponsorbadge">
              </div>
            </div>

            <!-- DOCTOR INFO -->
            <div>
              <div>
                <h5 class="ms-2 ">{{ doctor.user.name }} {{ doctor.user.last_name }}</h5>
                <p class="ms-2 m-0">Specializzazioni: </p>
                <div class="spec-list d-flex">
                  <p class="ms-2 m-0" v-for="specialization in doctor.specializations" :key="specialization.id">{{
                    specialization.name }},</p>
                </div>
                <p class="ms-2 m-0">Prestazioni: {{ doctor.performances }}</p>
              </div>
            </div>
          </div>
        </RouterLink>
      </li>
    </ul>
    <div class="d-flex">

      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li v-for="link in links" class="page-item" :class="link.active ? 'active' : ''"><a class="page-link"
              :class="link.url ? '' : 'disabled'" href="#" @click="fetchDoctors(link.url)" v-html="link.label"></a></li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<style lang="scss" scoped>
a {
  text-decoration: none;
  color: black;
}

ul {
  padding: 0;
}

.doctors-box {
  margin-top: 40px;
  padding: 0 25px;
}

.btn {
  background-color: #04D8C5;
  color: white;
  height: 35px;
}

.doctor-list {
  width: 100%;

  li {
    border: 4px solid rgba(4, 216, 198, 0.437);
    transition: box-shadow 1.2s;
  }

  li:hover {
    box-shadow: 9px 11px 11px #888888;
  }
}

.doc-image {
  height: 80px;
  width: 80px;
  border-radius: 50%;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;

  img {
    width: 100px;
  }
}

.spec-list {
  flex-wrap: wrap;
}

.doctor {
  display: flex;
  width: 100%;
  flex-shrink: 0;
}

.des {
  display: none;
}

li {
  list-style: none;
  margin-top: 15px;
  margin-right: 15px;
  border: 4px solid #04D8C5;
  border-radius: 44px 10px 10px 44px;
}


.pagination>.active>a {
  background-color: #03C3A5;
}

.pagination {
  flex-wrap: wrap;
}

.page-item {

  border: none;

  a {
    border: 1px solid #04D8C5;
    border-radius: 10px;
  }
}

.disabled {
  background-color: #03C3A5;
  color: white;
  font-size: 20px;
}

select {
  border: none;
  color: white;
  padding: 6px 7px;
  background-color: #04D8C5;
  border-radius: 10px;
}

option {
  background-color: white;
  color: black;
}

.sponsor-badge {
  position: relative;
  top: 0;
  left: 20px;
  height: 104px;
  border-radius: 0px 10px 0px 10px;
  overflow: hidden;

  img {
    height: 100%;
  }
}

@media screen and (min-width: 580px) {
  li {
    padding-right: 20px;

  }
}

@media screen and (min-width: 990px) {
  ul {
    display: flex;
  }

  li {
    margin-right: 10px;
    border: 4px solid #04D8C5;
    border-radius: 44px 10px 10px 10px;
  }

  .doctors-box {

    padding: 0 100px;
  }

  .doctor {
    height: 100%;
    display: block;
  }

  .des {
    display: block;
  }

  .filetform {
    display: flex;
    justify-content: space-between;
  }
}
</style>