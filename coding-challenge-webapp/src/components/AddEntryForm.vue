<template>
  <form @submit.prevent="handleSubmit">
    <div
      v-if="createSuccess"
      class="alert alert-success"
      role="alert"
    >Successfully created an entry.</div>
    <div class="form-group">
      <label for="name">Name</label>
      <input
        v-model="name"
        required
        type="text"
        class="form-control"
        id="name"
        placeholder="Enter name"
      >
    </div>
    <div class="form-group">
      <label for="campus">Campus</label>
      <input
        v-model="campus"
        required
        type="text"
        class="form-control"
        id="campus"
        placeholder="Enter campus"
      >
    </div>
    <div class="form-group">
      <label for="school">School</label>
      <input
        v-model="school"
        required
        type="text"
        class="form-control"
        id="school"
        placeholder="Enter school"
      >
    </div>
    <div class="form-group">
      <label for="division">Division</label>
      <input
        v-model="division"
        required
        type="text"
        class="form-control"
        id="division"
        placeholder="Enter division"
      >
    </div>
    <hr>
    <button
      :disabled="creatingEntry"
      style="float:right;"
      type="submit"
      class="btn btn-success"
    >{{creatingEntry ? 'Submitting...':'Submit'}}</button>
  </form>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      name: "",
      school: "",
      division: "",
      campus: "",
      createSuccess: false,
      creatingEntry: false
    };
  },
  methods: {
    handleSubmit() {
      this.creatingEntry = true;
      axios
        .post("/api/passers", {
          name: this.name,
          campus: this.campus,
          school: this.school,
          division: this.division
        })
        .then(response => {
          this.handleCreateSuccess();
        })
        .catch(error => {
          this.creatingEntry = false;
          alert(error);
        });
    },
    handleCreateSuccess() {
      this.creatingEntry = false;
      this.createSuccess = true;
      this.clearFields();
      setTimeout(() => {
        this.createSuccess = false;
      }, 5000);
    },
    clearFields() {
      this.name = "";
      this.campus = "";
      this.school = "";
      this.division = "";
    }
  }
};
</script>
