<template>
	<div class="container pt-5">
		<!-- with token -->
		<template v-if="token">
			<h1 class="mb-3">Alumnos</h1>
			<button
				type="button"
				class="btn btn-primary mb-2"
				data-toggle="modal"
				data-target="#modalNewUser"
			>
				Registrar usuario
			</button>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nombre</th>
						<th scope="col">Email</th>
						<th scope="col">Identificación</th>
						<th scope="col">Género</th>
						<th scope="col">Fecha nacimiento</th>
						<th scope="col">Carrera</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="alumno in users">
						<tr :key="alumno.id">
							<th scope="col">{{alumno.id}}</th>
							<th scope="col">{{alumno.name}}</th>
							<th scope="col">{{alumno.email}}</th>
							<th scope="col">
								<span v-if="alumno.id_type == 1">TI</span>
								<span v-if="alumno.id_type == 2">CC</span>
								<span v-if="alumno.id_type == 3">CE</span>
								 {{alumno.id_number}}
							</th>
							<th scope="col">
								<span v-if="alumno.genere == 1">Mujer</span>
								<span v-if="alumno.genere == 2">Hombre</span>
								<span v-if="alumno.genere == 3">Indeterminado</span>
							</th>
							<th scope="col">{{alumno.birthday}}</th>
							<th scope="col">
								<span v-if="alumno.career == 1">Medicina</span>
								<span v-if="alumno.career == 2">Sistemas</span>
								<span v-if="alumno.career == 3">Derecho</span>
							</th>
							<th scope="col">
								<button type="button" class="btn btn-light" @click="userEditShow(alumno.id)">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
									</svg>
								</button >
								<button type="button" class="btn btn-light" @click="userDelete(alumno.id)">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
										<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
									</svg>
								</button >
							</th>
						</tr>
					</template>
				</tbody>
			</table>

			<!-- Modal new user -->
			<div class="modal fade" id="modalNewUser" tabindex="-1" role="dialog" aria-labelledby="modalNewUserLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalNewUserLabel">Nuevo alumno</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label for="exampleInputName">Nombre</label>
									<input
										type="text"
										class="form-control"
										id="exampleInputName"
										aria-describedby="emailHelp"
										v-model="userNewModel.name"
									>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Email</label>
									<input
										type="email"
										class="form-control"
										id="exampleInputEmail1"
										aria-describedby="emailHelp"
										v-model="userNewModel.email"
									>
								</div>
								<div class="form-group">
									<label for="idType">Tipo identificación</label>
									<select
										class="form-control"
										id="idtype"
										v-model="userNewModel.id_type"
									>
										<option selected value="1">Tarjeta de identidad</option>
										<option value="2">Cédula</option>
										<option value="3">Cédula de extranjería</option>
									</select>
								</div>
								<div class="form-group">
									<label for="identification">Identificación</label>
									<input
										type="text"
										class="form-control"
										id="identification"
										v-model="userNewModel.id_number"
									>
								</div>
								<div class="form-group">
									<label for="idType">Género</label>
									<select
										class="form-control"
										id="idtype"
										v-model="userNewModel.genere"
									>
										<option selected value="1">Femenino</option>
										<option value="2">Masculino</option>
										<option value="3">No definido</option>
									</select>
								</div>
								<div class="form-group">
									<label for="birthday">Fecha nacimiento</label>
									<input
										type="date"
										class="form-control"
										id="birthday"
										v-model="userNewModel.birthday"
									>
								</div>
								<div class="form-group">
									<label for="career">Carrera</label>
									<select
										class="form-control"
										id="career"
										v-model="userNewModel.career"
									>
										<option selected value="1">Medicina</option>
										<option value="2">Sistemas</option>
										<option value="3">Derecho</option>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Contraseña</label>
									<input
										type="password"
										class="form-control"
										id="exampleInputPassword1"
										v-model="userNewModel.password"
									>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button
								type="button"
								class="btn btn-light"
								data-dismiss="modal"
							>
								Cancelar
							</button>
							<button
								type="button"
								class="btn btn-primary"
								@click="userNew()"
							>
								Crear
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal edit user -->
			<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalEditUserLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalEditUserLabel">Editar alumno</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label for="exampleInputName">Nombre</label>
									<input
										type="text"
										class="form-control"
										id="exampleInputName"
										aria-describedby="emailHelp"
										v-model="userEditModel.name"
									>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Email</label>
									<input
										type="email"
										class="form-control"
										id="exampleInputEmail1"
										aria-describedby="emailHelp"
										v-model="userEditModel.email"
									>
								</div>
								<div class="form-group">
									<label for="idType">Tipo identificación</label>
									<select
										class="form-control"
										id="idtype"
										v-model="userEditModel.id_type"
									>
										<option selected value="1">Tarjeta de identidad</option>
										<option value="2">Cédula</option>
										<option value="3">Cédula de extranjería</option>
									</select>
								</div>
								<div class="form-group">
									<label for="identification">Identificación</label>
									<input
										type="text"
										class="form-control"
										id="identification"
										v-model="userEditModel.id_number"
									>
								</div>
								<div class="form-group">
									<label for="idType">Género</label>
									<select
										class="form-control"
										id="idtype"
										v-model="userEditModel.genere"
									>
										<option selected value="1">Femenino</option>
										<option value="2">Masculino</option>
										<option value="3">No definido</option>
									</select>
								</div>
								<div class="form-group">
									<label for="birthday">Fecha nacimiento</label>
									<input
										type="date"
										class="form-control"
										id="birthday"
										v-model="userEditModel.birthday"
									>
								</div>
								<div class="form-group">
									<label for="career">Carrera</label>
									<select
										class="form-control"
										id="career"
										v-model="userEditModel.career"
									>
										<option selected value="1">Medicina</option>
										<option value="2">Sistemas</option>
										<option value="3">Derecho</option>
									</select>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button
								type="button"
								class="btn btn-light"
								data-dismiss="modal"
							>
								Cancelar
							</button>
							<button
								type="button"
								class="btn btn-primary"
								@click="userNew()"
							>
								Crear
							</button>
						</div>
					</div>
				</div>
			</div>
		</template>

		<template v-else>
			<form>
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input
						type="email"
						class="form-control"
						id="exampleInputEmail1"
						aria-describedby="emailHelp"
						v-model="login.email"
					>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input
						type="password"
						class="form-control"
						id="exampleInputPassword1"
						v-model="login.password"
					>
				</div>
				<button
					type="button"
					class="btn btn-primary"
					@click="userLogin()"
				>
					Submit
				</button>
			</form>
		</template>
	</div>
</template>

<script>
	import axios from 'axios';

	//import login from '././Login.vue';

	export default {
		data() {
			return {
				apiUrl:	`./api/`,
				token: false,
				login: {
					'email': 	'',
					'password':	''
				},
				userNewModel: {
					'name': 	'',
					'email': 	'',
					'id_type':	'',
					'id_number':'',
					'genere':	'',
					'birthday':	'',
					'career':	'',
					'password':	''
				},
				userEditModel: {},
				users: [],
			};
		},
		methods:{
			checkLogin: function(){
				if(window.localStorage.token){
					this.token = window.localStorage.token;
				}
			},
			userLogin: function(){
				axios
				.post(`${this.apiUrl}users/login`,
				{
					'email'		: this.login.email,
					'password'	: this.login.password
				})
				.then(response => {
					this.token = response.data.token;
					window.localStorage.setItem("token", this.token);
				})
			},
			userNew: function(){
				axios
				.post(`${this.apiUrl}users/new_user`, this.userNewModel)
				.then(response => {
					this.getUsers();
					$('#modalNewUser').modal('hide');
				})
			},

			userEditShow: function(idUser){
				$("#modalEditUser").modal('show');
				this.userEditModel = this.users.find(user => user.id === idUser);
			},
			userNew: function(){
				axios
				.put(`${this.apiUrl}users/edit/${this.userEditModel.id}`, this.userEditModel)
				.then(response => {
					this.getUsers();
					$('#modalEditUser').modal('hide');
				})
			},

			userDelete: function(idUser){
				axios
				.delete(`${this.apiUrl}users/delete/${idUser}`,{
					headers: {
						'Authorization': 'Bearer ' + this.token
					}
				})
				.then(response => {
					this.getUsers();
				})
			},

			getUsers: function(){
				axios
				.get(`${this.apiUrl}users/list`,{
					headers: {
						'Authorization': 'Bearer ' + this.token
					}
				})
				.then(response => {
					this.users = response.data;
				})
			}
		},
		mounted() {
			this.checkLogin();
			this.getUsers();
		}
	}
</script>
