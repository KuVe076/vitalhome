<?php
include 'conexion.php';

$datos = [
  "Arica y Parinacota" => ["Arica", "Camarones", "Putre", "General Lagos"],
  "Tarapacá" => ["Iquique", "Alto Hospicio", "Pozo Almonte", "Camiña", "Colchane", "Huara", "Pica"],
  "Antofagasta" => ["Antofagasta", "Mejillones", "Sierra Gorda", "Taltal", "Calama", "Ollagüe", "San Pedro de Atacama"],
  "Atacama" => ["Copiapó", "Caldera", "Tierra Amarilla", "Chañaral", "Diego de Almagro", "Vallenar", "Huasco", "Freirina"],
  "Coquimbo" => ["La Serena", "Coquimbo", "Andacollo", "La Higuera", "Paihuano", "Vicuña", "Illapel", "Canela", "Los Vilos", "Salamanca", "Ovalle", "Combarbalá", "Monte Patria", "Punitaqui", "Río Hurtado"],
  "Valparaíso" => ["Valparaíso", "Viña del Mar", "Concón", "Quintero", "Puchuncaví", "Casablanca", "Juan Fernández", "San Antonio", "Cartagena", "El Tabo", "El Quisco", "Algarrobo", "Santo Domingo", "Quillota", "La Calera", "La Cruz", "Nogales", "Hijuelas", "Petorca", "Cabildo", "Zapallar", "Papudo", "La Ligua", "San Felipe", "Catemu", "Llay Llay", "Panquehue", "Putaendo", "Los Andes", "Calle Larga", "Rinconada", "San Esteban"],
  "Metropolitana de Santiago" => ["Santiago", "Cerrillos", "Cerro Navia", "Conchalí", "El Bosque", "Estación Central", "Huechuraba", "Independencia", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipú", "Ñuñoa", "Pedro Aguirre Cerda", "Peñalolén", "Providencia", "Pudahuel", "Puente Alto", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Joaquín", "San Miguel", "San Ramón", "Vitacura", "San Bernardo", "Calera de Tango", "Buin", "Paine", "Melipilla", "Alhué", "Curacaví", "María Pinto", "San Pedro", "Talagante", "El Monte", "Isla de Maipo", "Padre Hurtado", "Peñaflor"],
  "O'Higgins" => ["Rancagua", "Machalí", "Graneros", "Mostazal", "Codegua", "Requínoa", "Rengo", "Malloa", "San Vicente", "Peumo", "Pichidegua", "Las Cabras", "San Fernando", "Chépica", "Nancagua", "Santa Cruz", "Lolol", "Pumanque", "Placilla", "Palmilla", "Peralillo", "Paredones", "Pichilemu", "La Estrella", "Litueche", "Navidad"],
  "Maule" => ["Talca", "San Clemente", "Pelarco", "Pencahue", "Maule", "San Rafael", "Curepto", "Constitución", "Empedrado", "Río Claro", "Colbún", "Linares", "Yerbas Buenas", "Longaví", "Retiro", "Parral", "Villa Alegre", "San Javier", "Cauquenes", "Chanco", "Pelluhue"],
  "Ñuble" => ["Chillán", "Chillán Viejo", "Bulnes", "Quillón", "San Ignacio", "El Carmen", "Pemuco", "Yungay", "Coihueco", "San Carlos", "San Nicolás", "Ninhue", "Quirihue", "Cobquecura", "Treguaco", "Portezuelo", "Ránquil"],
  "Biobío" => ["Concepción", "Talcahuano", "Hualpén", "San Pedro de la Paz", "Coronel", "Lota", "Tomé", "Penco", "Chiguayante", "Florida", "Hualqui", "Santa Juana", "Nacimiento", "Laja", "San Rosendo", "Los Ángeles", "Mulchén", "Negrete", "Quilaco", "Quilleco", "Santa Bárbara", "Alto Biobío"],
  "La Araucanía" => ["Temuco", "Padre Las Casas", "Vilcún", "Freire", "Pitrufquén", "Gorbea", "Lautaro", "Perquenco", "Galvarino", "Nueva Imperial", "Carahue", "Saavedra", "Teodoro Schmidt", "Toltén", "Cunco", "Melipeuco", "Curarrehue", "Pucón", "Villarrica", "Loncoche", "Panguipulli"],
  "Los Ríos" => ["Valdivia", "Corral", "Lanco", "Los Lagos", "Máfil", "Mariquina", "Paillaco", "Panguipulli", "La Unión", "Río Bueno"],
  "Los Lagos" => ["Puerto Montt", "Puerto Varas", "Llanquihue", "Frutillar", "Calbuco", "Maullín", "Los Muermos", "Fresia", "Ancud", "Castro", "Chonchi", "Curaco de Vélez", "Dalcahue", "Puqueldón", "Queilén", "Quellón", "Quemchi", "Quinchao", "Osorno", "Río Negro", "Purranque", "Puerto Octay", "San Juan de la Costa", "San Pablo"],
  "Aysén" => ["Coyhaique", "Lago Verde", "Aysén", "Cisnes", "Guaitecas", "Río Ibáñez", "Chile Chico", "Cochrane", "O'Higgins", "Tortel"],
  "Magallanes" => ["Punta Arenas", "Puerto Natales", "Porvenir", "Primavera", "San Gregorio", "Cabo de Hornos", "Antártica"]
];

foreach ($datos as $region => $comunas) {
  foreach ($comunas as $comuna) {
    $regionEscaped = $conn->real_escape_string($region);
    $comunaEscaped = $conn->real_escape_string($comuna);
    $sql = "INSERT INTO regiones_comunas (region, comuna) VALUES ('$regionEscaped', '$comunaEscaped')";
    $conn->query($sql);
  }
}

echo "Regiones y comunas insertadas correctamente.";
$conn->close();
?>