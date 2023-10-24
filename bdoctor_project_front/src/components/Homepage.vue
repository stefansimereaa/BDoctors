<script >
import Header from './Header.vue';
import Footer from './Footer.vue';
export default {
  name: 'Homepage',
  components: { Header, Footer },
}
</script>

<template>
  <Header />
  <RouterView />
  <Footer />
</template>

<style scoped></style>
