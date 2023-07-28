
const ANSWER_TYPE = {
    SINGLE_CHOICE: 'App\\Models\\AnswersTypeSingleChoice',
    MULTIPLE_CHOICE: 'App\\Models\\AnswersTypeMultipleChoice',
    RIGHT_ORDER: 'App\\Models\\AnswersTypeRightOrder',
    TEXT_INPUT: 'App\\Models\\AnswersTypeTextInput'
}

const ANSWER_TYPES = [
    {
        type: ANSWER_TYPE.SINGLE_CHOICE,
        title: 'Выбор одного варианта ответа'
    },

    {
        type: ANSWER_TYPE.MULTIPLE_CHOICE,
        title: 'Выбор нескольких вариантов ответа'
    },

    {
        type: ANSWER_TYPE.RIGHT_ORDER,
        title: 'Расстановка в нужном порядке'
    },

    {
        type: ANSWER_TYPE.TEXT_INPUT,
        title: 'Ввод ответа с клавиатуры'
    }

];

Object.freeze(ANSWER_TYPE);
Object.freeze(ANSWER_TYPES);

window.ANSWER_TYPE = ANSWER_TYPE;
window.ANSWER_TYPES = ANSWER_TYPES;
