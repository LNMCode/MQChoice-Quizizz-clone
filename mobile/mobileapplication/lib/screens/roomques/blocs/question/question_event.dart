import 'package:equatable/equatable.dart';
import 'package:mobileapplication/models/getroom/question.dart';

abstract class QuestionEvent extends Equatable {
  const QuestionEvent();

  @override
  List<Object?> get props => [];
}

class QuestionConnectSocket extends QuestionEvent {
  final String idroom;
  final String iduser;

  const QuestionConnectSocket(
    this.idroom,
    this.iduser,
  );
}

class QuestionWasAnswer extends QuestionEvent {
  final String idroom;
  final String iduser;
  final String idques;
  final String idans;
  final String valueans;

  const QuestionWasAnswer(
    this.idroom,
    this.iduser,
    this.idques,
    this.idans,
    this.valueans,
  );
}

class QuestionEventNextQuestion extends QuestionEvent{}
