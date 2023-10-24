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

        orderDoctorsByReviews(doctors) {
            let reviews = [];
            let index;
            let newDoctors = [];
            let blacklist = [];

            doctors.forEach((doctor) => {
                reviews.push(doctor.reviews.length)
            })

            if (this.reviewsFilter == 1) {

                for (let j = 0; j < doctors.length; j++) {
                    let min = 999999;
                    for (let i = 0; i < reviews.length; i++) {
                        if (reviews[i] <= min && !blacklist.includes(i)) {
                            min = reviews[i];
                            index = i;
                        }
                    }
                    blacklist.push(index);
                    newDoctors.push(doctors[index]);
                }

            }
            else {

                for (let j = 0; j < doctors.length; j++) {
                    let max = -1;
                    for (let i = 0; i < reviews.length; i++) {
                        if (reviews[i] >= max && !blacklist.includes(i)) {
                            max = reviews[i];
                            index = i;
                        }
                    }
                    blacklist.push(index);
                    newDoctors.push(doctors[index]);
                }
            }
            return newDoctors;
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
            // Se sono attivi tutti i filtri 
            else if (this.specializationFilter && this.averageFilter && this.reviewsFilter) {
                axios.get(endpoint + 'doctors/specialization/' + this.specializationFilter + '/' + this.averageFilter + '/' + this.reviewsFilter).then(res => {
                    let flag = 0;
                    let filteredDoctors = [];


                    this.links = res.data.links
                    res.data.data.forEach((doctor) => {
                        doctor.specializations.forEach((specialization) => {
                            if (specialization.id == this.specializationFilter) flag = 1;
                        })
                        if (flag) {
                            filteredDoctors.push(doctor);
                            flag = 0;
                        }
                    })



                    let averages = [];

                    filteredDoctors.forEach((doctor) => {
                        let sum = 0;

                        doctor.ratings.forEach((rating) => {
                            sum += parseInt(rating.vote);
                        })
                        const roundedRating = Math.round(sum / doctor.ratings.length);
                        averages.push(roundedRating);
                    })

                    filteredDoctors.forEach((doctor, index) => {
                        if (averages[index] >= this.averageFilter) newDoctors.push(doctor);
                    })

                    this.doctors = newDoctors;
                })
            }
            // // Se sono attivi specializzazioni e recensioni
            else if (this.specializationFilter && this.reviewsFilter) {
                axios.get(endpoint + 'doctors/specialization/' + this.specializationFilter + '/0/' + this.reviewsFilter).then(res => {
                    let flag = 0;
                    let filteredDoctors = [];

                    if (this.specializationFilter == '0' && this.averageFilter == '0') {
                        this.fetchDoctors();
                    }
                    else {

                        let flag = 0;
                        this.links = res.data.links
                        res.data.data.forEach((doctor) => {
                            doctor.specializations.forEach((specialization) => {
                                if (specialization.id == this.specializationFilter) flag = 1;
                            })
                            if (flag) {
                                filteredDoctors.push(doctor);
                                flag = 0;
                            }
                        })

                    }

                    let averages = [];

                    filteredDoctors.forEach((doctor) => {
                        let sum = 0;

                        doctor.ratings.forEach((rating) => {
                            sum += parseInt(rating.vote);
                        })
                        const roundedRating = Math.round(sum / doctor.ratings.length);
                        console.log(roundedRating);
                        averages.push(roundedRating);
                    })

                    filteredDoctors.forEach((doctor, index) => {
                        if (averages[index] >= this.averageFilter) newDoctors.push(doctor);
                    })

                    if (this.reviewsFilter != '0') this.doctors = this.orderDoctorsByReviews(newDoctors);
                    else this.doctors = newDoctors;
                })
            }


            // Se sono attivi specializzazioni e media voti minima
            else if (this.specializationFilter && this.averageFilter) {
                axios.get(endpoint + 'doctors/specialization/' + this.specializationFilter + '/' + this.averageFilter + '/0').then(res => {
                    let flag = 0;
                    let filteredDoctors = [];

                    if (this.specializationFilter == '0' && this.averageFilter == '0') {
                        this.fetchDoctors();
                    }
                    else {

                        let flag = 0;
                        this.links = res.data.links
                        res.data.data.forEach((doctor) => {
                            doctor.specializations.forEach((specialization) => {
                                if (specialization.id == this.specializationFilter) flag = 1;
                            })
                            if (flag) {
                                filteredDoctors.push(doctor);
                                flag = 0;
                            }
                        })

                    }

                    let averages = [];

                    filteredDoctors.forEach((doctor) => {
                        let sum = 0;

                        doctor.ratings.forEach((rating) => {
                            sum += parseInt(rating.vote);
                        })
                        const roundedRating = Math.round(sum / doctor.ratings.length);
                        console.log(roundedRating);
                        averages.push(roundedRating);
                    })

                    filteredDoctors.forEach((doctor, index) => {
                        if (averages[index] >= this.averageFilter) newDoctors.push(doctor);
                    })

                    if (this.reviewsFilter != '0') this.doctors = this.orderDoctorsByReviews(newDoctors);
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
        calculateAverage(ratings) {
            if (ratings.length === 0) {
                return 0;
            }

            // Use parseFloat to ensure that ratings are treated as numbers
            const sum = ratings.reduce((total, rating) => total + parseFloat(rating.vote), 0);
            const average = sum / ratings.length;
            return average.toFixed(1);
        }

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
        <h1>doctors</h1>
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
            <div class="my-2"><!-- Filtro media voti -->
                <label for="average" class="ms-md-2">Media voti minima: </label>
                <select class="ms-2" id="average" v-model="averageFilter" @change="fetchFilteredDoctors()">
                    <option value="0">Seleziona...</option>
                    <option value="1"> 1 stella </option>
                    <option value="2"> 2 stelle </option>
                    <option value="3"> 3 stelle </option>
                    <option value="4"> 4 stelle </option>
                    <option value="5"> 5 stelle </option>
                </select>
            </div>
            <div class="my-2"><!-- Filtro numero di recensioni -->
                <label for="reviews" class="ms-md-2">Ordina per numero minimo di recensioni: </label>
                <select class="ms-2" id="reviews" v-model="reviewsFilter" @change="fetchFilteredDoctors()">
                    <option value="0">Seleziona...</option>
                    <option value="5"> 5 a 10 </option>
                    <option value="10"> 10 a 50 </option>
                    <option value="50"> 50 a 100 </option>
                </select>
            </div>
        </form>

        <!-- DOCTOR LIST -->
        <ul class="doctor-list" id="doctor-list">
            <!-- DOCTOR CARD -->
            <div class="row">
                <li v-for="doctor in   doctors  ">

                    <RouterLink :to="{ name: 'profile', params: { id: doctor.id } }">
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
                                        <p class="ms-2 m-0" v-for="specialization in doctor.specializations"
                                            :key="specialization.id">{{
                                                specialization.name }},</p>
                                    </div>
                                    <div class="ms-2 mt-3">
                                        <h5>Media voti</h5>
                                        <!-- Inseriamo il codice per visualizzare le recensioni qui -->
                                        <p>
                                            <font-awesome-icon v-for="i in 5" :key="i"
                                                :icon="i <= calculateAverage(doctor.ratings) ? ['fas', 'star'] : ['far', 'star']" />
                                        </p>

                                    </div>
                                    <p class="ms-2 m-0">Prestazioni: {{ doctor.performances }}</p>
                                </div>
                            </div>
                        </div>
                    </RouterLink>
                </li>
            </div>
        </ul>
        <div class="d-flex">

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-for="  link   in   links  " class="page-item" :class="link.active ? 'active' : ''"><a
                            class="page-link" :class="link.url ? '' : 'disabled'" href="#" @click="fetchDoctors(link.url)"
                            v-html="link.label"></a></li>
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

option {
    color: black;
}

.doctors-box {
    margin-top: 40px;
    padding: 0 25px;
}

.btn {
    background-color: rgb(22, 178, 50);
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

.doctor-list li {
    list-style: none;
    flex: 0 0 auto;
    width: calc(50% - 20px);
    margin: 15px 10px 0px 10px;
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
        margin-right: 10px;
    }
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
}

@media screen and (min-width: 580px) {
    .doctor-list li {
        padding-right: 20px;
        padding-left: 0;
    }
}

@media screen and (min-width: 990px) {
    ul {
        display: flex;
    }

    .doctor-list li {
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