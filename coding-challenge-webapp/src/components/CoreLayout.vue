<template>
  <div class="core">
    <Nav/>
    <slot></slot>
  </div>
</template>

<script>
import Nav from "./Nav";

export default {
  components: { Nav },
  data() {
    return {};
  }
};
</script>
