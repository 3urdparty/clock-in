/* eslint-disable */
/* prettier-ignore */
// @ts-nocheck
// Generated by laravel-typescriptable
declare namespace App.Route {
  export type Name = '/' | 'api/calendar' | 'api/fingerprints/delete' | 'api/fingerprints/enroll' | 'api/queue' | 'api/scan' | 'api/statistics' | 'api/sync' | 'api/user' | 'devices.destroy' | 'devices.employees.destroy' | 'devices.employees.index' | 'devices.employees.show' | 'devices.employees.store' | 'devices.employees.update' | 'devices.index' | 'devices.show' | 'devices.store' | 'devices.update' | 'employees.destroy' | 'employees.fingerprints.destroy' | 'employees.fingerprints.index' | 'employees.fingerprints.show' | 'employees.fingerprints.store' | 'employees.fingerprints.update' | 'employees.index' | 'employees.show' | 'employees.store' | 'employees.update' | 'fingerprints.destroy' | 'fingerprints.index' | 'fingerprints.show' | 'fingerprints.store' | 'fingerprints.update' | 'sanctum.csrf-cookie' | 'shifts.destroy' | 'shifts.index' | 'shifts.show' | 'shifts.store' | 'shifts.update' | 'up';
  export type Path = '/' | '/api/calendar' | '/api/devices' | '/api/devices/{device}' | '/api/devices/{device}/employees' | '/api/devices/{device}/employees/{employee}' | '/api/employees' | '/api/employees/{employee}' | '/api/employees/{employee}/fingerprints' | '/api/employees/{employee}/fingerprints/{fingerprint}' | '/api/fingerprints' | '/api/fingerprints/delete' | '/api/fingerprints/enroll' | '/api/fingerprints/{fingerprint}' | '/api/queue' | '/api/scan' | '/api/shifts' | '/api/shifts/{shift}' | '/api/statistics' | '/api/sync' | '/api/user' | '/sanctum/csrf-cookie' | '/up';
  export interface Params {
    'sanctum.csrf-cookie': never
    'api/user': never
    'employees.index': never
    'employees.store': never
    'employees.show': {
      'employee': App.Route.ParamType
    }
    'employees.update': {
      'employee': App.Route.ParamType
    }
    'employees.destroy': {
      'employee': App.Route.ParamType
    }
    'devices.index': never
    'devices.store': never
    'devices.show': {
      'device': App.Route.ParamType
    }
    'devices.update': {
      'device': App.Route.ParamType
    }
    'devices.destroy': {
      'device': App.Route.ParamType
    }
    'devices.employees.index': {
      'device': App.Route.ParamType
    }
    'devices.employees.store': {
      'device': App.Route.ParamType
    }
    'devices.employees.show': {
      'device': App.Route.ParamType
'employee': App.Route.ParamType
    }
    'devices.employees.update': {
      'device': App.Route.ParamType
'employee': App.Route.ParamType
    }
    'devices.employees.destroy': {
      'device': App.Route.ParamType
'employee': App.Route.ParamType
    }
    'shifts.index': never
    'shifts.store': never
    'shifts.show': {
      'shift': App.Route.ParamType
    }
    'shifts.update': {
      'shift': App.Route.ParamType
    }
    'shifts.destroy': {
      'shift': App.Route.ParamType
    }
    'fingerprints.index': never
    'fingerprints.store': never
    'fingerprints.show': {
      'fingerprint': App.Route.ParamType
    }
    'fingerprints.update': {
      'fingerprint': App.Route.ParamType
    }
    'fingerprints.destroy': {
      'fingerprint': App.Route.ParamType
    }
    'api/statistics': never
    'api/calendar': never
    'employees.fingerprints.index': {
      'employee': App.Route.ParamType
    }
    'employees.fingerprints.store': {
      'employee': App.Route.ParamType
    }
    'employees.fingerprints.show': {
      'employee': App.Route.ParamType
'fingerprint': App.Route.ParamType
    }
    'employees.fingerprints.update': {
      'employee': App.Route.ParamType
'fingerprint': App.Route.ParamType
    }
    'employees.fingerprints.destroy': {
      'employee': App.Route.ParamType
'fingerprint': App.Route.ParamType
    }
    'api/scan': never
    'api/sync': never
    'api/queue': never
    'api/fingerprints/enroll': never
    'api/fingerprints/delete': never
    'up': never
    '/': never
  };

  export type Method = 'HEAD' | 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE'
  export type ParamType = string | number | boolean | undefined
  export interface Link { name: App.Route.Name; path: App.Route.Path; params?: App.Route.Params[App.Route.Name], methods: App.Route.Method[] }
  export interface RouteConfig<T extends App.Route.Name> {
    name: T
    params?: T extends keyof App.Route.Params ? App.Route.Params[T] : never
  }
}
