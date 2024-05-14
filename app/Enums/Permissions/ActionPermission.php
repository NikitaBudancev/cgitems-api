<?php

namespace App\Enums\Permissions;

enum ActionPermission: string
{
    case showProject = 'show project';
    case createProject = 'create project';
    case updateProject = 'update project';
    case deleteProject = 'delete project';
    case addAvatar = 'add avatar';
}
