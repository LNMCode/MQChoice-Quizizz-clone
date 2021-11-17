import 'package:equatable/equatable.dart';

class QuestionState extends Equatable {
  const QuestionState();

  @override
  List<Object?> get props => [];
}

// For connection to server
class QuestionAnswerConnecting extends QuestionState{}

class QuestionAnswerConnectSuccess extends QuestionState{}

class QuestionAnswerConnectFail extends QuestionState{}

// For answer question
class QuestionAnswerLoading extends QuestionState {}

class QuestionAnswerSuccess extends QuestionState {}

class QuestionAnswerFail extends QuestionState {}

// Next question
class QuestionAnswerNextQuestion extends QuestionState{}