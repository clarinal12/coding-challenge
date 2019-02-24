<template>
  <div class="passers-table-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3>2018 PSHS NCE Passers</h3>
          <br>
          <div class="d-flex">
            <div style="padding:0 !important;" class="mr-auto p-2">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Search By:</label>
                </div>
                <div class="input-group-append">
                  <select v-model="searchBy" class="custom-select" id="inputGroupSelect02">
                    <option value="name">Name</option>
                    <option value="school">School:</option>
                    <option value="division">Division</option>
                  </select>
                </div>
                <div class="input-group-append">
                  <input
                    v-model="searchValue"
                    v-on:keyup.enter="appendQuerySearch"
                    style="padding-left:10px;"
                    placeholder="At least 4 characters..."
                    type="text"
                  >
                </div>
                <div class="input-group-append">
                  <button @click="appendQuerySearch" class="btn btn-primary">Search</button>
                </div>
              </div>
            </div>
            <div style="padding:0 !important;" class="p-2">
              <div class="mb-3">
                <button @click="modalShow = !modalShow" class="btn btn-success">Add Entry</button>
                <b-modal title="Add Entry" hide-footer v-model="modalShow">
                  <AddEntryForm/>
                </b-modal>
              </div>
            </div>
          </div>
          <table class="table table-striped table-responsive-lg">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Campus</th>
                <th scope="col">School</th>
                <th scope="col">Division</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(passer, index) in passers" :key="index">
                <td>{{passer.name.toUpperCase()}}</td>
                <td>{{passer.campus.toUpperCase()}}</td>
                <td>{{passer.school.toUpperCase()}}</td>
                <td>{{passer.division.toUpperCase()}}</td>
              </tr>
              <tr v-if="passers.length == 0 && !fetchingPassers">
                <td colspan="4" style="text-align:center">
                  <h4>No Data</h4>
                </td>
              </tr>
              <tr v-if="fetchingPassers">
                <td colspan="4" style="text-align:center">
                  <h4>Fetching...</h4>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-sm-12">
          <b-pagination
            align="right"
            :total-rows="total"
            v-model="query.page"
            :per-page="query.limit"
          />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import AddEntryForm from "./AddEntryForm";
import axios from "axios";

export default {
  components: { AddEntryForm },
  data() {
    return {
      passers: [],
      total: 0,
      query: {
        limit: 50,
        page: 1,
        name: null,
        school: null,
        division: null
      },
      searchBy: "name",
      searchValue: "",
      modalShow: false,
      fetchingPassers: false
    };
  },
  mounted() {
    this.fetchPassers();
  },
  watch: {
    query: {
      handler(query) {
        this.fetchPassers();
      },
      deep: true
    },
    searchValue: function(newValue) {
      if (newValue == "") {
        this.appendQuerySearch();
      }
    }
  },
  methods: {
    fetchPassers() {
      this.passers = [];
      this.fetchingPassers = true;
      axios
        .get("/api/passers", {
          params: this.query
        })
        .then(response => {
          this.fetchingPassers = false;
          this.passers = response.data.data;
          this.total = response.data.meta.total;
        })
        .catch(error => {
          this.fetchingPassers = false;
          alert("failed to fetch passers.");
        });
    },
    appendQuerySearch() {
      if (this.searchValue.length > 3 || this.searchValue.length == 0) {
        this.query.name = null;
        this.query.school = null;
        this.query.division = null;
        this.query[this.searchBy] = this.searchValue;
      } else {
        alert("Please enter at 4 characters for searching.");
        return;
      }
    }
  }
};
</script>
