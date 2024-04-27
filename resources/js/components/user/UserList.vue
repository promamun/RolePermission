<script setup>
import $ from 'jquery';
import axios from 'axios';
import spinningOverLay from '../spinning-overlay/SpinningOverLay.vue';
import {ref, onMounted, watch} from 'vue';
import ModalAddUser from "./modals/ModalAddUser.vue";

const users = ref([]);
const spinner = ref(false);
let dataTableInstance = null;

const userList = async () => {
  try {
    const response = await axios.get('/admin/user-list');
    users.value = response.data;

    // Initialize DataTables once users are fetched
    initializeDataTable();
  } catch (error) {
    console.error('Error fetching user list:', error);
  }
};

const initializeDataTable = () => {
  dataTableInstance = $('.datatables-users').DataTable({
    dom:
      '<"row me-2"' +
      '<"col-md-2"<"me-3"l>>' +
      '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
      '>t' +
      '<"row mx-2"' +
      '<"col-sm-12 col-md-6"i>' +
      '<"col-sm-12 col-md-6"p>' +
      '>',
    language: {
      sLengthMenu: '_MENU_',
      search: '',
      searchPlaceholder: 'Search..'
    },
    // Buttons with Dropdown
    buttons: [
      {
        extend: 'collection',
        className: 'btn btn-label-secondary dropdown-toggle mx-3 waves-effect waves-light',
      },
      {
        text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New User</span>',
        className: 'add-new btn btn-primary waves-effect waves-light',
        attr: {
          'data-bs-toggle': 'modal',
          'data-bs-target': '#addUserModal'
        }
      }
    ],
    data: users.value,
    columns: [
      {
        render: (data, type, row, meta) => meta.row + 1
      },
      {
        data: 'name',
      },
      {
        data: 'name',
        render: (data, type, row) => row.name
      },
      {
        data: 'role',
        render: (data, type, row) => row.name
      },{
        data: 'role',
        render: (data, type, row) => row.name
      },
    ],
  });
};


onMounted(() => {
  userList();
});

// Watch for changes in users ref and update DataTable
watch(users, () => {
  if (dataTableInstance) {
    dataTableInstance.clear().rows.add(users.value).draw();
  }
});
</script>

<template>
  <spinningOverLay :spinner="spinner" />
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Session</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">21,459</h3>
                <p class="text-success mb-0">(+29%)</p>
              </div>
              <p class="mb-0">Total Users</p>
            </div>
            <div class="avatar">
                          <span class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-user ti-sm"></i>
                          </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Paid Users</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">4,567</h3>
                <p class="text-success mb-0">(+18%)</p>
              </div>
              <p class="mb-0">Last week analytics</p>
            </div>
            <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="ti ti-user-plus ti-sm"></i>
                          </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Active Users</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">19,860</h3>
                <p class="text-danger mb-0">(-14%)</p>
              </div>
              <p class="mb-0">Last week analytics</p>
            </div>
            <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="ti ti-user-check ti-sm"></i>
                          </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Pending Users</span>
              <div class="d-flex align-items-center my-2">
                <h3 class="mb-0 me-2">237</h3>
                <p class="text-success mb-0">(+42%)</p>
              </div>
              <p class="mb-0">Last week analytics</p>
            </div>
            <div class="avatar">
                          <span class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-user-exclamation ti-sm"></i>
                          </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-datatable table-responsive">
      <table class="datatables-users table">
        <thead class="border-top">
        <tr>
          <th>SN</th>
          <th>User</th>
          <th>Role</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
        </thead>
      </table>
    </div>
  </div>
  <modal-add-user />
</template>
