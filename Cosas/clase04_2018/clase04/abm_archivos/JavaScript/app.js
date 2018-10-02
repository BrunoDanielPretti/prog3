/// <reference path="ajax.ts" />
window.onload = function () {
    Main.MostrarGrilla();
};
var Main;
(function (Main) {
    var ajax = new Ajax();
    function MostrarGrilla() {
        var parametros = "queHago=mostrarGrilla";
        ajax.Post("http://localhost/clase04/abm_archivos/administracion.php", MostrarGrillaSuccess, parametros, Fail);
    }
    Main.MostrarGrilla = MostrarGrilla;
    function AgregarProducto() {
        var queHagoObj = document.getElementById("hdnQueHago");
        var frm = document.getElementById("frm");
        frm.action = "administracion.php";
        frm.method = "post";
        frm.submit();
    }
    Main.AgregarProducto = AgregarProducto;
    function EliminarProducto(codBarra) {
        if (!confirm("Desea ELIMINAR el PRODUCTO " + codBarra + "??")) {
            return;
        }
        var parametros = "queHago=eliminar&codBarra=" + codBarra;
        ajax.Post("http://localhost/clase04/abm_archivos/administracion.php", DeleteSuccess, parametros, Fail);
    }
    Main.EliminarProducto = EliminarProducto;
    function ModificarProducto(codBarra, nombre) {
        document.getElementById("codBarra").value = codBarra.toString();
        document.getElementById("nombre").value = nombre;
        document.getElementById("hdnQueHago").value = "modificar";
        document.getElementById("codBarra").readOnly = true;
    }
    Main.ModificarProducto = ModificarProducto;
    function MostrarGrillaSuccess(grilla) {
        console.clear();
        console.log(grilla);
        document.getElementById("divGrilla").innerHTML = grilla;
    }
    function DeleteSuccess(retorno) {
        console.clear();
        console.log(retorno);
        alert(retorno);
        MostrarGrilla();
    }
    function Fail(retorno) {
        console.clear();
        console.log(retorno);
        alert("Ha ocurrido un ERROR!!!");
    }
})(Main || (Main = {}));
