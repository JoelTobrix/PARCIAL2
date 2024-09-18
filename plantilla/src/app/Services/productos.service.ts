import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { IProductos } from '../Interfaces/iproductos';  // Cambia la interfaz a IProducto
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductosService {
  apiurl = 'http://localhost/parcial/03MVC/controllers/productos.controller.php?op=';
  constructor(private lector: HttpClient) {}

  buscar(texto: string): Observable<IProductos> {
    const formData = new FormData();
    formData.append('texto', texto);
    return this.lector.post<IProductos>(this.apiurl + 'uno', formData);
  }

  todos(): Observable<IProductos[]> {
    return this.lector.get<IProductos[]>(this.apiurl + 'todos');
  }

  uno(producto_id: number): Observable<IProductos> {
    const formData = new FormData();
    formData.append('producto_id', producto_id.toString());
    return this.lector.post<IProductos>(this.apiurl + 'uno', formData);
  }

  eliminar(producto_id: number): Observable<number> {
    const formData = new FormData();
    formData.append('producto_id', producto_id.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(producto: IProductos): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', producto.nombre);
    formData.append('descripcion', producto.descripcion);
    formData.append('precio', producto.precio.toString());
    formData.append('stock', producto.stock.toString());
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(producto: IProductos): Observable<string> {
    const formData = new FormData();
    formData.append('producto_id', producto.producto_id.toString());
    formData.append('nombre', producto.nombre);
    formData.append('descripcion', producto.descripcion);
    formData.append('precio', producto.precio.toString());
    formData.append('stock', producto.stock.toString());
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
