<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permisos sobre los permisos
        Permission::create(['name' => 'permissions.index', 'description' => 'Ver listado de permisos']);
        Permission::create(['name' => 'permissions.show', 'description' => 'Ver detalle de un permiso']);
        Permission::create(['name' => 'permissions.store', 'description' => 'Crear un nuevo permiso']);
        Permission::create(['name' => 'permissions.update', 'description' => 'Actualizar un permiso existente']);
        Permission::create(['name' => 'permissions.destroy', 'description' => 'Eliminar un permiso']);

        // Permisos sobre los roles
        Permission::create(['name' => 'roles.index', 'description' => 'Ver listado de roles']);
        Permission::create(['name' => 'roles.show', 'description' => 'Ver detalle de un rol']);
        Permission::create(['name' => 'roles.store', 'description' => 'Crear un rol']);
        Permission::create(['name' => 'roles.update', 'description' => 'Actualizar un rol']);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar un rol']);

        // Permisos sobre usuarios
        Permission::create(['name' => 'users.index', 'description' => 'Ver listado de usuarios']);
        Permission::create(['name' => 'users.show', 'description' => 'Ver detalle de cualquier usuario']);
        Permission::create(['name' => 'users.show-own', 'description' => 'Ver mi propio usuario']);
        Permission::create(['name' => 'users.store', 'description' => 'Crear un usuario']);
        Permission::create(['name' => 'users.update', 'description' => 'Actualizar cualquier usuario']);
        Permission::create(['name' => 'users.update-role', 'description' => 'Actualizar el rol de un usuario']);
        Permission::create(['name' => 'users.update-own-email', 'description' => 'Actualizar mi propio email']);
        Permission::create(['name' => 'users.update-own-password', 'description' => 'Actualizar mi propia contraseña']);
        Permission::create(['name' => 'users.destroy', 'description' => 'Eliminar un usuario']);

        // Permisos sobre estados de usuarios
        Permission::create(['name' => 'statuses.index', 'description' => 'Ver listado de estados de usuario']);
        Permission::create(['name' => 'statuses.show', 'description' => 'Ver detalle de un estado']);
        Permission::create(['name' => 'statuses.store', 'description' => 'Crear un estado']);
        Permission::create(['name' => 'statuses.update', 'description' => 'Actualizar un estado']);
        Permission::create(['name' => 'statuses.destroy', 'description' => 'Eliminar un estado']);

        // Permisos sobre ciudades
        Permission::create(['name' => 'cities.index', 'description' => 'Ver listado de ciudades']);
        Permission::create(['name' => 'cities.show', 'description' => 'Ver detalle de una ciudad']);
        Permission::create(['name' => 'cities.store', 'description' => 'Crear una ciudad']);
        Permission::create(['name' => 'cities.update', 'description' => 'Actualizar una ciudad']);
        Permission::create(['name' => 'cities.destroy', 'description' => 'Eliminar una ciudad']);

        // Permisos sobre géneros
        Permission::create(['name' => 'genders.index', 'description' => 'Ver listado de géneros']);
        Permission::create(['name' => 'genders.show', 'description' => 'Ver detalle de un género']);
        Permission::create(['name' => 'genders.store', 'description' => 'Crear un género']);
        Permission::create(['name' => 'genders.update', 'description' => 'Actualizar un género']);
        Permission::create(['name' => 'genders.destroy', 'description' => 'Eliminar un género']);

        // Permisos sobre colores
        Permission::create(['name' => 'colors.index', 'description' => 'Ver listado de colores']);
        Permission::create(['name' => 'colors.show', 'description' => 'Ver detalle de un color']);
        Permission::create(['name' => 'colors.store', 'description' => 'Crear un color']);
        Permission::create(['name' => 'colors.update', 'description' => 'Actualizar un color']);
        Permission::create(['name' => 'colors.destroy', 'description' => 'Eliminar un color']);

        // Permisos sobre perfiles
        Permission::create(['name' => 'profiles.index', 'description' => 'Ver listado de perfiles']);
        Permission::create(['name' => 'profiles.show', 'description' => 'Ver detalle de cualquier perfil']);
        Permission::create(['name' => 'profiles.show-own', 'description' => 'Ver mi propio perfil']);
        Permission::create(['name' => 'profiles.show-user', 'description' => 'Ver perfil de un usuario específico']);
        Permission::create(['name' => 'profiles.store', 'description' => 'Crear un perfil']);
        Permission::create(['name' => 'profiles.update', 'description' => 'Actualizar cualquier perfil']);
        Permission::create(['name' => 'profiles.update-own', 'description' => 'Actualizar mi propio perfil']);

        // Permisos sobre tipos de movimientos
        Permission::create(['name' => 'transaction-types.index', 'description' => 'Ver listado de tipos de movimientos']);
        Permission::create(['name' => 'transaction-types.show', 'description' => 'Ver detalle de un tipo de movimiento']);
        Permission::create(['name' => 'transaction-types.store', 'description' => 'Crear un tipo de movimiento']);
        Permission::create(['name' => 'transaction-types.update', 'description' => 'Actualizar un tipo de movimiento']);
        Permission::create(['name' => 'transaction-types.destroy', 'description' => 'Eliminar un tipo de movimiento']);

        // Permisos sobre categorías de movimientos
        Permission::create(['name' => 'transaction-categories.index', 'description' => 'Ver listado de categorías de movimientos']);
        Permission::create(['name' => 'transaction-categories.index-own', 'description' => 'Ver mis propias categorías de movimientos']);
        Permission::create(['name' => 'transaction-categories.show', 'description' => 'Ver detalle de una categoría de movimiento']);
        Permission::create(['name' => 'transaction-categories.store', 'description' => 'Crear una categoría de movimiento']);
        Permission::create(['name' => 'transaction-categories.update', 'description' => 'Actualizar una categoría de movimiento']);
        Permission::create(['name' => 'transaction-categories.destroy', 'description' => 'Eliminar una categoría de movimiento']);

        // Permisos sobre movimientos
        Permission::create(['name' => 'transactions.index', 'description' => 'Ver listado de movimientos']);
        Permission::create(['name' => 'transactions.index-own', 'description' => 'Ver mis propios movimientos']);
        Permission::create(['name' => 'transactions.show', 'description' => 'Ver detalle de un movimiento']);
        Permission::create(['name' => 'transactions.show-own', 'description' => 'Ver detalle de mis propios movimientos']);
        Permission::create(['name' => 'transactions.store', 'description' => 'Crear un movimiento']);
        Permission::create(['name' => 'transactions.update', 'description' => 'Actualizar un movimiento']);
        Permission::create(['name' => 'transactions.destroy', 'description' => 'Eliminar un movimiento']);

        // Permisos sobre estados de metas
        Permission::create(['name' => 'goal-statuses.index', 'description' => 'Ver listado de estados de metas']);
        Permission::create(['name' => 'goal-statuses.show', 'description' => 'Ver detalle de un estado de meta']);
        Permission::create(['name' => 'goal-statuses.store', 'description' => 'Crear un estado de meta']);
        Permission::create(['name' => 'goal-statuses.update', 'description' => 'Actualizar un estado de meta']);
        Permission::create(['name' => 'goal-statuses.destroy', 'description' => 'Eliminar un estado de meta']);

        // Permisos sobre metas
        Permission::create(['name' => 'goals.index', 'description' => 'Ver listado de metas']);
        Permission::create(['name' => 'goals.index-own', 'description' => 'Ver mis propias metas']);
        Permission::create(['name' => 'goals.show', 'description' => 'Ver detalle de una meta']);
        Permission::create(['name' => 'goals.show-own', 'description' => 'Ver detalle de mis propias metas']);
        Permission::create(['name' => 'goals.store', 'description' => 'Crear una meta']);
        Permission::create(['name' => 'goals.update', 'description' => 'Actualizar una meta']);
        Permission::create(['name' => 'goals.destroy', 'description' => 'Eliminar una meta']);
        Permission::create(['name' => 'goals.destroy-safe', 'description' => 'Eliminar una meta de manera segura']);

        // Permisos sobre tipos de movimientos de metas
        Permission::create(['name' => 'goal-transaction-types.index', 'description' => 'Ver listado de tipos de movimientos de metas']);
        Permission::create(['name' => 'goal-transaction-types.show', 'description' => 'Ver detalle de un tipo de movimiento de meta']);
        Permission::create(['name' => 'goal-transaction-types.store', 'description' => 'Crear un tipo de movimiento de meta']);
        Permission::create(['name' => 'goal-transaction-types.update', 'description' => 'Actualizar un tipo de movimiento de meta']);
        Permission::create(['name' => 'goal-transaction-types.destroy', 'description' => 'Eliminar un tipo de movimiento de meta']);

        // Permisos sobre movimientos de metas
        Permission::create(['name' => 'goal-transactions.index', 'description' => 'Ver listado de movimientos de metas']);
        Permission::create(['name' => 'goal-transactions.index-own', 'description' => 'Ver mis propios movimientos de metas']);
        Permission::create(['name' => 'goal-transactions.show', 'description' => 'Ver detalle de un movimiento de meta']);
        Permission::create(['name' => 'goal-transactions.show-own', 'description' => 'Ver detalle de mis propios movimientos de metas']);
        Permission::create(['name' => 'goal-transactions.store', 'description' => 'Crear un movimiento de meta']);
        Permission::create(['name' => 'goal-transactions.update', 'description' => 'Actualizar un movimiento de meta']);
        Permission::create(['name' => 'goal-transactions.destroy', 'description' => 'Eliminar un movimiento de meta']);

        // Permisos balance
        Permission::create(['name' => 'balance.show', 'description' => 'Ver balance general']);
        Permission::create(['name' => 'balance.show-own', 'description' => 'Ver mi balance']);

        // Permisos frontend - roles de acceso
        Permission::create(['name' => 'super-admin', 'description' => 'Acceso a funcionalidades de super-admin']);
        Permission::create(['name' => 'admin', 'description' => 'Acceso a funcionalidades de admin']);
        Permission::create(['name' => 'user', 'description' => 'Acceso a funcionalidades de usuario']);

        // Permisos frontend - acceso a vistas
        Permission::create(['name' => 'admin.access', 'description' => 'Acceso a vistas de admin']);
        Permission::create(['name' => 'super-admin.access', 'description' => 'Acceso a vistas de super-admin']);
        Permission::create(['name' => 'home.access', 'description' => 'Acceso a vista de inicio']);
        Permission::create(['name' => 'goals.access', 'description' => 'Acceso a vistas de metas']);
        Permission::create(['name' => 'calendar.access', 'description' => 'Acceso a vistas de calendario']);
        Permission::create(['name' => 'profile.access', 'description' => 'Acceso a vistas de perfil']);
        Permission::create(['name' => 'users.access', 'description' => 'Acceso a vistas de usuarios']);
        Permission::create(['name' => 'cities.access', 'description' => 'Acceso a vistas de ciudades']);
        Permission::create(['name' => 'genders.access', 'description' => 'Acceso a vistas de géneros']);
        Permission::create(['name' => 'colors.access', 'description' => 'Acceso a vistas de colores']);
        Permission::create(['name' => 'statuses.access', 'description' => 'Acceso a vistas de estados']);
        Permission::create(['name' => 'goal-statuses.access', 'description' => 'Acceso a vistas de estados de metas']);
        Permission::create(['name' => 'transaction-types.access', 'description' => 'Acceso a vistas de tipos de movimientos']);
        Permission::create(['name' => 'goal-transaction-types.access', 'description' => 'Acceso a vistas de tipos de movimientos de metas']);
        Permission::create(['name' => 'transaction-categories.access', 'description' => 'Acceso a vistas de categorías de movimientos']);
        Permission::create(['name' => 'roles.access', 'description' => 'Acceso a vistas de roles']);
        Permission::create(['name' => 'permissions.access', 'description' => 'Acceso a vistas de permisos']);
    
        Permission::create(['name' => 'icons.index', 'description' => 'Ver listado de íconos']);
        Permission::create(['name' => 'icons.show', 'description' => 'Ver detalle de un ícono']);
        Permission::create(['name' => 'icons.store', 'description' => 'Crear un nuevo ícono']);
        Permission::create(['name' => 'icons.update', 'description' => 'Actualizar un ícono existente']);
        Permission::create(['name' => 'icons.destroy', 'description' => 'Eliminar un ícono']);
        Permission::create(['name' => 'icons.access', 'description' => 'Acceso a vistas de íconos']);

    }
}
