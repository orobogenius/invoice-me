<template>
  <div class="dashboard">
    <sidebar class="dashboard__sidebar pt-5"></sidebar>
    <main class="dashboard__content pt-4">
      <div class="page-name p-2 pl-5">
        <h5>Dashboard</h5>
      </div>
      <div class="mt-3 p-4">
        <transition name="fade" mode="out-in">
          <router-view></router-view>
        </transition>
      </div>
    </main>
  </div>
</template>

<script>
import Sidebar from "./Sidebar.vue";

export default {
  name: "app",
  components: {
    Sidebar
  }
};
</script>
