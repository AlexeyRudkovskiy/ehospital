import { NomenclatureShow } from './controllers/nomenclature-show'
import { ContractorShow } from './controllers/contractor-show'
import {PatientShow} from "./controllers/patient-show";

export function router () {
    return [
        {
            prefix: 'management',
            actions: {
                'nomenclature.show': NomenclatureShow,
                'contractor.show': ContractorShow,
                'patient.show': PatientShow,
            }
        }
    ];
}
