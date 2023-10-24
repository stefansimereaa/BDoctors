<script >
import DoctorList from './DoctorList.vue';
import ReviewsList from './ReviewsList.vue';
import Sponsor from './Sponsor.vue';
export default {
  name: 'Main',
  data: () => ({}),
  components: { ReviewsList, DoctorList, Sponsor }
}
</script>

<template>
  <main>
    <!-- DOCTOR LIST -->
    <DoctorList />
    <!-- SPONSOR -->
    <Sponsor />
    <!-- NEWS LIST -->
    <ReviewsList />
  </main>
</template>

<style scoped></style>
