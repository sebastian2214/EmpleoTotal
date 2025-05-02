export interface Job {
  id_oferta_empleo: number;
  titulo_emp: string;
  empresas_id: number;
  descripcion: string;
  requisitos: string;
  ubicacion: string;
  salario: string;
  oferta_empleocol?: string; 
  telefono: string;
  link_test?: string; 
  correo: string;
  sub_cat_id_sub_cat: number;
}
