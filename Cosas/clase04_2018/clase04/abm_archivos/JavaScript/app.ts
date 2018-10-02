/// <reference path="ajax.ts" />

window.onload = ():void => {
    Main.MostrarGrilla();
}; 

namespace Main{
    
        let ajax : Ajax = new Ajax();
    
        export function MostrarGrilla():void {

            let parametros:string = `queHago=mostrarGrilla`;

            ajax.Post("http://localhost/clase04/abm_archivos/administracion.php", 
                        MostrarGrillaSuccess, 
                        parametros, 
                        Fail);            
        }

        export function AgregarProducto():void {
            
            let queHagoObj = (<HTMLInputElement>document.getElementById("hdnQueHago"));
            let frm = (<HTMLFormElement>document.getElementById("frm"));
            
            frm.action = "administracion.php";
            frm.method = "post";
            frm.submit();
                            
        }
        
        export function EliminarProducto(codBarra:number):void {

            if(!confirm("Desea ELIMINAR el PRODUCTO "+codBarra+"??")){
                return;
            }

            let parametros:string = `queHago=eliminar&codBarra=${codBarra}`;
            
            ajax.Post("http://localhost/clase04/abm_archivos/administracion.php", 
            DeleteSuccess, 
            parametros, 
            Fail);
            
        }
    
        export function ModificarProducto(codBarra:number, nombre:string):void {

            (<HTMLInputElement>document.getElementById("codBarra")).value = codBarra.toString();
            (<HTMLInputElement>document.getElementById("nombre")).value = nombre;
            (<HTMLInputElement>document.getElementById("hdnQueHago")).value = "modificar";

            (<HTMLInputElement>document.getElementById("codBarra")).readOnly = true;
        }

        function MostrarGrillaSuccess(grilla:string):void {
            console.clear();
            console.log(grilla);
            (<HTMLDivElement>document.getElementById("divGrilla")).innerHTML = grilla;
        }

        function DeleteSuccess(retorno:string):void {
            console.clear();
            console.log(retorno);
            alert(retorno);
            MostrarGrilla();
        }
    
        function Fail(retorno:string):void {
            console.clear();
            console.log(retorno);
            alert("Ha ocurrido un ERROR!!!");
        }
    
}