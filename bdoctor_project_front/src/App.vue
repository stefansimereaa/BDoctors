<script>
import Homepage from './components/Homepage.vue';
export default {
  components: { Homepage },
  data: () => ({}),

}
</script>

<template>
  <header>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  </header>


  <body>
    <Homepage />

  </body>
</template>

<style>
* {
  font-family: 'Roboto', sans-serif;
}
</style>
