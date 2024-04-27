<script setup>
import { ref} from "vue";
import spinningOverLay from "@/components/spinning-overlay/SpinningOverLay.vue";
import axios from "axios";
// Create a ref to track loading state
const spinning = ref(false);
const userName = ref('');

// Define custom events
const  emit  = defineEmits(['updateUserList']);

// Function to emit the custom event
const emitUpdateRoleList = () => {
  emit('updateUserList');
};
const submitForm = () => {
    const user = {
        name: userName.value,
    }
    spinning.value=true;
    axios.post('/admin/roles/store',rolePermissions).then(res=>{
        if (res.data.message) {
            toastr.success(res.data.message);
            closeModal();
            emitUpdateRoleList();
        } else if (res.data.error) {
            toastr.error(res.data.error);
        }
    }).catch(error=>{
        console.log(error)
        toastr.error(error.response.data.error);
    }).finally(()=>{
        spinning.value=false;
    })
};
// Method to close the modal and reset form
const closeModal = () => {
    const addModalClose = document.getElementById('addModalClose')
    addModalClose.click()
    // Reset form
    userName.value = '';
};
</script>

<template>
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <spinningOverLay :spinner="spinning"/>
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <div class="modal-content p-3 p-md-5">
                <button type="button" id="addModalClose" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3 class="role-title mb-2">Add New User</h3>
                        <p class="text-muted">Set role permissions</p>
                    </div>
                    <!-- Add role form -->
                    <form class="row g-3" @submit.prevent="submitForm">
                        <div class="col-12 mb-4">
                            <label class="form-label" for="modalRoleName">Role Name</label>
                            <input type="text" id="modalRoleName" required v-model="roleName" class="form-control" placeholder="Enter a role name" tabindex="-1" />
                        </div>
                        <div class="col-12">
                            <h5>Role Permissions</h5>
                            <!-- Permission table -->
                            <div class="table-responsive">
                                <table class="table table-flush-spacing">
                                    <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-medium">Administrator Access <i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                                        <td>
                                            <div class="form-check">
                                                <input @change="selectAllRoutes" v-model="selectAll"  class="form-check-input" type="checkbox" id="selectAll" />
                                                <label class="form-check-label" for="selectAll">
                                                    Select All
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-for="(routeGroup, index) in filteredRouteList" :key="index">
                                        <td class="text-nowrap fw-medium">{{ routeGroup.prefix }}</td>
                                        <td >
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5" v-for="(route, routeIndex) in routeGroup.routes" :key="routeIndex">
                                                    <input v-model="selectedRoutesName" :value="route.name" class="form-check-input" type="checkbox" :id="'route_' + index + '_' + routeIndex" />
                                                    <label class="form-check-label" :for="'route_' + index + '_' + routeIndex">
                                                        {{ route.name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Permission table -->
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
