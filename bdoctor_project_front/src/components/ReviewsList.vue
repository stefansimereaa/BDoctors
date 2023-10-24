<script >
import axios from 'axios';
const endpoint = 'http://127.0.0.1:8000/api/reviews';
export default {
  name: 'NewsList',
  data: () => ({
    reviews: [],
    ratings: [],
    prevPageURI: null,
    nextPageURI: null,
    links: null,
  }),
  methods: {
    fetchReviews(uri = endpoint) {
      axios.get(uri).then(res => {

        this.reviews = res.data.data
        this.links = res.data.links

      })
    }
  },
  created() {
    this.fetchReviews()
  }
}
</script>

<template>
  <!-- REVIEWS -->
  <div class="reviews-box" id="reviews-box">
    <h1 class="ms-3 mb-4">Ultime recensioni</h1>
    <!-- REVIEWS CARD -->
    <ul>
      <div class="row">
        <li v-for="review in reviews " class="reviews pe-2">
          <a href="#reviews-box" alt="review">
            <div class="review mx-3">
              <div class="mt-3">
                <div class="d-flex">

                  <div class="doc-image mb-3 ms-2">
                    <img v-if="review.doctor.profile_photo" :src="review.doctor.profile_photo">
                    <img v-else src="../assets/img/placeholder.jpg">
                  </div>
                  <div>
                    <h3 class="ms-3 ms-0">Dr. {{ review.name }}</h3>
                    <h6 class="ms-3 mt-3">{{ review.doctor.user.name }} {{
                      review.doctor.user.last_name }}</h6>
                    <p class="ms-3 m-0">{{ review.text }}</p>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </li>
      </div>
    </ul>
    <nav aria-label="Page navigation example">
      <ul class="pagination my-5">
        <li v-for="link in links" class="page-item" :class="link.active ? 'active' : ''"><a class="page-link"
            :class="link.url ? '' : 'disabled'" href="#reviews-box" @click="fetchReviews(link.url)"
            v-html="link.label"></a></li>
      </ul>
    </nav>
  </div>
</template>

<style lang="scss" scoped>
.reviews-box {
  margin-top: 70px;
  padding: 0 25px;
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

.review {
  height: 150px;
  border: 3px solid rgba(4, 216, 198, 0.437);
  transition: box-shadow 1.2s;
  border-radius: 0px 25px 25px 25px;
}

a {
  text-decoration: none;
  /* padding: 0; */
  color: black;
}

li.reviews {
  list-style: none;
  margin-top: 15px;
}

ul {
  width: 100%;
  padding-left: 0;
}

.pagination>.active>a {
  background-color: #03C3A5;
  border: none;
}

.page-item {
  margin-top: 15px;
  margin-right: 15px;
}

.pagination {
  display: flex;
  flex-wrap: wrap;
}

.page-link {
  border: 1px solid #03C3A5;
  border-radius: 10px;
}

.disabled {
  background-color: #03C3A5;
}

.page-link:hover {
  color: black;
}

.active>.page-link {
  color: white;
}

@media screen and (min-width: 780px) {
  ul {
    display: flex;
  }

  li.reviews {
    width: calc(100% / 2)
  }

  .row {
    margin-right: 0;
  }

  .review {
    height: 250px;
  }
}

@media screen and (min-width: 990px) {
  .reviews-box {
    padding: 0 80px;
  }
}

@media screen and (min-width: 1400px) {
  li.reviews {
    width: calc(100% / 3)
  }
}
</style>