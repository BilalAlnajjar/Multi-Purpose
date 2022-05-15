<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users Table</h3>

                                <div class="card-tools">
                                    <button class="btn btn-success" @click="openCreateModel">New Add
                                        <i class="fas fa-user-plus fa-fw"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Registered At</th>
                                        <th>Type</th>
                                        <th>Modify</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="user in users" :key="user.id">
                                        <td>{{user.id}}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ myDate(user.created_at)}}</td>
                                        <td><span class="tag tag-success">{{uperText(user.usertype)}}</span></td>
                                        <td>
                                            <a href="#" @click="openEditModel(user)">
                                                <i class="fas fa-edit blue"></i>
                                            </a>
                                            |
                                            <a href="#" @click="deleteuser(user.id)">
                                                <i class="fas fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

                <!-- Modal toggle -->
                <!--                <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="adduser">-->
                <!--                    Toggle modal-->
                <!--                </button>-->


                <!-- Modal -->
                <div class="modal fade " id="createuser" tabindex="-1" role="dialog" aria-labelledby="createuser" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered lg:left-24 " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 v-show="!editmodal" class="modal-title" id="exampleModalLongTitle">Add New</h5>
                                <h5 v-show="editmodal" class="modal-title" id="exampleModalLongTitle">Update User's Info</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="editmodal ? updateuser() :createUser()">

                                    <div class="flex justify-center">
                                        <div class="w-5/6">

                                            <div class="my-3">
                                                <!--                                        <label for="name" class="form-label">Name</label>-->
                                                <input id="name" v-model="form.name" type="text" name="name" class="form-control" :class="{'is-invalid' : form.errors.has('name')}" placeholder="Name">
                                                <HasError :form="form" field="name" />
                                            </div>

                                            <div class="my-3">
                                                <!--                                        <label for="name" class="form-label">Name</label>-->
                                                <input id="email" v-model="form.email" type="text" name="email" class="form-control" :class="{'is-invalid' : form.errors.has('email')}" placeholder="Email Address">
                                                <HasError :form="form" field="email" />
                                            </div>

                                            <div class="my-3">
                                                <!--                                        <label for="name" class="form-label">Name</label>-->
                                                <textarea id="bio" v-model="form.bio" name="bio" class="form-control" placeholder="Short bio for user (optional)" :class="{'is-invalid' : form.errors.has('bio')}"></textarea>
                                                <HasError :form="form" field="bio" />
                                            </div>

                                            <div class="my-3">
                                                <!--                                        <label for="name" class="form-label">Name</label>-->
                                                <select id="usertype" v-model="form.usertype" type="text" name="usertype" class="form-control" :class="{'is-invalid' : form.errors.has('usertype')}" placeholder="Email Address">
                                                    <option value="admin">Admin</option>
                                                    <option value="user">Standard User</option>
                                                    <option value="author">Author</option>
                                                </select>
                                                <HasError :form="form" field="usertype" />
                                            </div>

                                            <div class="my-3">
                                                <!--                                        <label for="password" class="form-label">Password</label>-->
                                                <input id="password" v-model="form.password" placeholder="Password" type="password" name="password" :class="{'is-invalid' : form.errors.has('password')}" class="form-control">
                                                <HasError :form="form" field="password" />
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                            <div class="modal-footer">

                                    <button data-dismiss="modal"  type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium leading-tight uppercase rounded text-sm px-5 py-2.5 shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Decline</button>
                                    <!--                                <button data-modal-toggle="adduser" type="button" class="text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-400 dark:hover:bg-green-600 dark:focus:ring-green-800">Create</button>-->
                                    <button v-show="!editmodal" @click="loadUsers"   type="submit" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium leading-tight uppercase text-sm px-5 py-2.5 text-center rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Create</button>
                                    <button v-show="editmodal" @click="loadUsers"   type="submit" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium leading-tight uppercase text-sm px-5 py-2.5 text-center rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Update</button>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>
    </div>

</template>

<script>
import Form from "vform";
import moment from 'moment';
export default {
    data(){
        return {
            users:{},
            editmodal: false,
            form: new Form({
                id: '',
                name: "",
                email: '',
                password: '',
                usertype: '',
                bio: '',
                photo: '',
            })
        }
    },
    methods:{
        openCreateModel(){
            this.editmodal = false;
            this.form.reset();
            $("#createuser").modal('show');
        },
        openEditModel(user){
            this.editmodal = true;
            this.form.reset();
            $("#createuser").modal('show');
            this.form.fill(user)
        },
        loadUsers(){
            axios.get('api/user').then(res => {
                this.users = res.data.data
            });
        },
        createUser(){
            this.form.post('api/user')
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'User Created in successfully'
                    });

                    $("#createuser").modal('hide');

                    this.loadUsers();
                })
                .catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'error in create user'
                    });
                });
        },
        updateuser(){
            // console.log("bilal");
            this.form.put('api/user/'+this.form.id)
                .then(() => {
                    $("#createuser").modal('hide');
                    this.loadUsers();
                    Swal.fire(
                        'Updated!',
                        'Updated User is successfully.',
                        'success'
                    )

                })
                .catch(() => {

                });
        },

        uperText(text){
            return text.charAt(0).toUpperCase() + text.slice(1);
        },
        myDate(date){
            return moment(date).format("MMM Do YY");
        },

        deleteuser(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send request to the server
                this.form.delete("api/user/"+id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    this.loadUsers();
                }).catch(() => {
                    Swal("Failed","There was something wronge.", 'warning');
                });
                }

            })
        }

    },
    created() {
        this.loadUsers();
        // setInterval(() => this.loadUsers(),3000);
    },
    name: "Users"
}
</script>
