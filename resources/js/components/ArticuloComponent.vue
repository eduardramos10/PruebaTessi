<template >
  <div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"></div>

          <div class="card-body">
              <h1>Menu Articulo</h1>
              <hr class="mt-3">
              <hr class="mt-3">
            <h2>
                  Agregar Articulo
              </h2>
    <hr class="mt-3">
            <div class="form-group">
              <div class="input-icon right">
                <input
                  type="text"
                  placeholder="Numero de Registro"
                  class="form-control"
                  v-model="numero_registro"
                  name="numero_registro"
                />
              </div>
              <hr class="mt-3">

              <div class="input-icon right">
                <input
                  type="text"
                  placeholder="Nombre Articulo"
                  class="form-control"
                  v-model="nombre"
                  name="nombre"
                />
              </div>

              <hr class="mt-3">
              <div class="input-icon right">
                <input
                  type="text"
                  placeholder="Cantidad"
                  class="form-control"
                  v-model="cantidad"
                  name="cantidad"
                />
              </div>
<hr class="mt-3">
              <label class="control-label col-md-3">Categoria</label>
              <select class="form-control" v-model="categoria_id">
                <option
                  v-for="(item, index) in listar_categorias_dd"
                  :key="index"
                  v-bind:value="item.id"
                >
                  {{ item.nombre_categoria }}
                </option>
              </select>
            </div>

            <br />
            <button
              type="button"
               class="btn btn-primary"
              @click="insertarArticulos()"
            >
              Guardar Articulo
            </button>
            <br />

            <div class="text-center" v-if="this.validacionNumero == 1">
              <h4 style="color: red">
                Reporte en existencia, por favor ingrese uno con otro N. registro
              </h4>
            </div>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Numero Registro</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in listar_articulos" :key="index">
                  <th scope="row">{{ item.numero_registro }}</th>
                  <td>{{ item.nombre }}</td>
                  <td>{{ item.cantidad }}</td>
                  <td>{{ item.categoria.nombre_categoria }}</td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-warning btn-sm"
                      data-toggle="modal"
                      data-target="#ArticuloModal"
                      @click="
                        datosMod(
                          item.id,
                          item.numero_registro,
                          item.nombre,
                          item.cantidad,
                          item.categoria_id
                        )
                      "
                    >
                      Editar
                    </button>
                    <button
                      type="button"
                      class="btn btn-danger btn-sm"
                      @click="eliminarArticulo(item.id)"
                    >
                      Eliminar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="text-center">
              <a type="button" class="btn btn-success" href="excel">
                Descargar Reporte articulos
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal EDITAR -->
      <div
        class="modal fade"
        id="ArticuloModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ArticuloModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ArticuloModalLabel">
                Editar Categoria
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label class="control-label col-md-3">Numero</label>
              <div class="input-icon right">
                <input
                  type="text"
                  class="form-control"
                  v-model="mod_numero_registro"
                  name="mod_numero_registro"
                />
              </div>

              <label class="control-label col-md-3">Nombre</label>
              <div class="input-icon right">
                <input
                  type="text"
                  class="form-control"
                  v-model="mod_nombre"
                  name="mod_nombre"
                />
              </div>

              <label class="control-label col-md-3">Cantidad</label>
              <div class="input-icon right">
                <input
                  type="text"
                  class="form-control"
                  v-model="mod_cantidad"
                  name="mod_cantidad"
                />
              </div>

              <label class="control-label col-md-3">Categoria</label>
              <select class="form-control" v-model="mod_categoria_id">
                <option
                  v-for="(item, index) in listar_categorias_dd"
                  :key="index"
                  v-bind:value="item.id"
                >
                  {{ item.nombre_categoria }}
                </option>
              </select>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Cerrar
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="modificarArticulo()"
              >
                Guardar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "articulo-component",
  data() {
    return {
      listar_articulos: [],
      listar_categorias_dd: [],
      listar_numeroRegistro: [],
      numero_registro: null,
      nombre: null,
      cantidad: null,
      categoria_id: null,
      mod_numero_registro: null,
      mod_nombre: null,
      mod_cantidad: null,
      mod_categoria_id: null,
      valor: true,
      validacionNumero: null,
    };
  },
  created() {
    this.listaArticulos();
    this.listaCategoriasDesplegable();
    this.numeroRegistros();
  },
  updated() {
    this.listaArticulos();
    this.listaCategoriasDesplegable();
    this.numeroRegistros();
  },
  methods: {
    listaArticulos() {
      axios.get(`articulover`).then((response) => {
        this.listar_articulos = response.data;
      });
    },
    listaCategoriasDesplegable() {
      axios.get(`categoriaver`).then((response) => {
        this.listar_categorias_dd = response.data;
      });
    },
    insertarArticulos() {
      this.valor = false;
      this.validacionNumero = null;
      for (var i = 0; i < this.listar_numeroRegistro.length; i++) {
        var info = this.listar_numeroRegistro[i];
        if (info == this.numero_registro) {
          this.valor = true;
        }
      }

      if (this.valor) {
        this.validacionNumero = 1;
      } else {
        let formData = new FormData();
        formData.append("numero_registro", this.numero_registro);
        formData.append("nombre", this.nombre);
        formData.append("cantidad", this.cantidad);
        formData.append("categoria_id", this.categoria_id);
        axios.post(`articulocrear`, formData);
        this.numero_registro = null;
        this.nombre = null;
        this.cantidad = null;
      }
    },
    datosMod(id_art, numeroRegistro, Nomb, Cant, CategoriaId) {
      this.mod_id = id_art;
      this.mod_numero_registro = numeroRegistro;
      this.mod_nombre = Nomb;
      this.mod_cantidad = Cant;
      this.mod_categoria_id = CategoriaId;
    },
    modificarArticulo() {
      const modificar = {
        numero_registro: this.mod_numero_registro,
        nombre: this.mod_nombre,
        cantidad: this.mod_cantidad,
        categoria_id: this.mod_categoria_id,
      };
      axios
        .put(`articulomodificar/${this.mod_id}`, modificar)
        .then((respuesta) => {
          location.reload();
        });
    },
    eliminarArticulo(id) {
      axios.delete(`articuloeliminar/${id}`);
    },
    numeroRegistros() {
      axios.get(`registroempty`).then((response) => {
        this.listar_numeroRegistro = response.data;
      });
    },
  },
};
</script>
