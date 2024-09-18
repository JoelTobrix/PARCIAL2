import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormControl, FormGroup, ReactiveFormsModule, ValidationErrors, Validators } from '@angular/forms';
import { ProductosService } from 'src/app/Services/productos.service'; // Asegúrate de tener este servicio
import { IProductos } from 'src/app/Interfaces/iproductos'; // Asegúrate de tener esta interfaz
import { CommonModule } from '@angular/common';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-nuevoproducto',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './nuevoproducto.component.html',
  styleUrls: ['./nuevoproducto.component.scss']
})
export class NuevoproductoComponent implements OnInit {
  frm_Producto = new FormGroup({
    nombre: new FormControl('', Validators.required),
    descripcion: new FormControl('', Validators.required),
    precio: new FormControl('', [Validators.required, Validators.min(0)]),
    stock: new FormControl('', [Validators.required, Validators.min(0)])
  });

  producto_id = 0;
  titulo = 'Nuevo Producto';

  constructor(
    private productoServicio: ProductosService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.producto_id = parseInt(this.ruta.snapshot.paramMap.get('idProducto') || '0', 10);
    if (this.producto_id > 0) {
      this.productoServicio.uno(this.producto_id).subscribe((unproducto) => {
        this.frm_Producto.controls['nombre'].setValue(unproducto.nombre);
        this.frm_Producto.controls['descripcion'].setValue(unproducto.descripcion);
        this.frm_Producto.controls['precio'].setValue(unproducto.precio);
        this.frm_Producto.controls['stock'].setValue(unproducto.stock);

        this.titulo = 'Editar Producto';
      });
    }
  }

  grabar() {
    let producto: IProductos = {
      producto_id: this.producto_id,
      nombre: this.frm_Producto.controls['nombre'].value,
      descripcion: this.frm_Producto.controls['descripcion'].value,
      precio: this.frm_Producto.controls['precio'].value,
      stock: this.frm_Producto.controls['stock'].value
    };

    Swal.fire({
      title: 'Productos',
      text: '¿Desea guardar el Producto ' + this.frm_Producto.controls['nombre'].value + '?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f00',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Grabar!'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.producto_id > 0) {
          this.productoServicio.actualizar(producto).subscribe((res: any) => {
            Swal.fire({
              title: 'Productos',
              text: res.mensaje,
              icon: 'success'
            });
            this.navegacion.navigate(['/productos']);
          });
        } else {
          this.productoServicio.insertar(producto).subscribe((res: any) => {
            Swal.fire({
              title: 'Productos',
              text: res.mensaje,
              icon: 'success'
            });
            this.navegacion.navigate(['/productos']);
          });
        }
      }
    });
  }
}
