<template>
  <div class="passers-table-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3>2018 PSHS NCE (Number of passers per school)</h3>
          <br>
          <table class="table table-striped table-responsive-lg">
            <thead>
              <tr>
                <th scope="col">School</th>
                <th scope="col">No. of Passers</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(result, index) in results" :key="index">
                <td>{{result.school.toUpperCase()}}</td>
                <td>{{result.passers}}</td>
              </tr>
              <tr v-if="fetchingResults">
                <td colspan="2" style="text-align:center">
                  <h4>Fetching...</h4>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  components: {},
  data() {
    return {
      results: [],
      fetchingResults: false
    };
  },
  mounted() {
    this.fetchResults();
  },
  watch: {},
  methods: {
    fetchResults() {
      this.fetchingResults = true;
      axios
        .get("/api/passers/presentation")
        .then(response => {
          this.fetchingResults = false;
          this.results = response.data.data;
        })
        .catch(error => {
          this.fetchingResults = false;
          alert("failed to fetch results.");
        });
    }
  }
};
</script>
