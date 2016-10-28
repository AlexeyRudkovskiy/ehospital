import { NomenclatureShow } from './controllers/nomenclature-show'
import { ContractorShow } from './controllers/contractor-show'

export function router () {
    return [
        {
            prefix: 'management',
            actions: {
                'nomenclature.show': NomenclatureShow,
                'contractor.show': ContractorShow
            }
        }
    ];
}
