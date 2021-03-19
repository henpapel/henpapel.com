<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<!-- iconos -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<!-- iconos -->
<style type="text/css">
    
    /*se importan los iconos*/
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");
</style>

<div id="divPapel" class="container mt-5">
    
    <h3 id="lblTitulo" class="text-center">Papel: (aqui va el papel)</h3>

    <form class="">

        <div class="mb-3">
            
            <label for="txtNombre">Nombre papel:</label>
            <input @keyup="vacios('txtNombre')" v-model="txtNombre" :class="['form-control', error ? 'is-invalid' : '']" id="txtNombre" placeholder="Ingrese un nombre" required />
            <div class="invalid-feedback">Ese papel ya esta registrado
            </div>
        </div>

        <div class="mb-3">
            
            <label for="txtDescripcion">Descripción papel:</label>
            <textarea v-model="txtDescripcion" :class="['form-control', error ? 'is-invalid' : '']" id="txtDescripcion" placeholder="Ingrese un comentario" required></textarea>
            <div class="invalid-feedback">Por favor ingrese una descripción
            </div>
        </div>

        <div class="mb-3">
            
            <label for="txtColor">Color papel:</label>
            <input v-model="txtColor" :class="['form-control', error ? 'is-invalid' : '']" id="txtColor" placeholder="Ingrese un color" required />
            <div class="invalid-feedback">Por favor ingrese un color
            </div>
        </div>

        <div class="mb-3">
            
            <label for="txtAlgo">Color papel:</label>
            <input :class="['form-control', error ? 'is-invalid' : '']" id="txtAlgo" placeholder="Ingrese un color" required />
            <div class="invalid-feedback">Por favor ingrese un color
            </div>
        </div>
        <button class="btn btn-success btn-block">Actualizar</button>
    </form>
</div>

<script type="text/javascript">
    
    const divPapel = new Vue({

        el:'#divPapel',
        data:{

            error: false,
            mensaje: '',
            datos: JSON.parse('<?php echo json_encode($datos)?>'),
            txtNombre: '',
            txtDescripcion: '',
            txtColor: ''
        },
        methods:{

            vacios(prop){

                let text = $('#'+prop).val()
                if( text == '' ){

                    this.prop = true
                }else{

                    this.prop = false
                }
                
                
            }
        },
        created: function(){

            console.log(this.datos)
            this.txtNombre= this.datos.nombre
            this.txtDescripcion= this.datos.descripcion
            this.txtColor= this.datos.color
            $('#lblTitulo').html(this.datos.nombre)
        },
        computed:{

            nombreVacio(algo){
                console.log(algo)
                let error1 = false
                if( this.txtNombre === '' ) error1 = true

                return error1
            }
        }
    });
</script>