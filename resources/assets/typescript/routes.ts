import { NomeclatureShow } from './controllers/nomenclature-show'
import { ContractorShow } from './controllers/contractor-show'

export function router () {
    return [
        {
            prefix: 'management',
            actions: {
                'nomenclature.show': NomeclatureShow,
                'contractor.show': ContractorShow
            }
        }
    ];
}
